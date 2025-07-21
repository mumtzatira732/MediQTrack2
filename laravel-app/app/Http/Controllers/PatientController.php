<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;


use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Queue;
use App\Mail\VerifyEmailCode;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\DB;


class PatientController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Patient Login',
            'action' => route('patient.login'),
            'registerLink' => route('patient.register'),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $patient = Patient::where('email', $credentials['email'])->first();

        if (!$patient) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        // Check if verified
        if (!$patient->is_verified) {
            return redirect()->route('patient.otp.form', ['email' => $patient->email])
                ->with('error', 'Please verify your email before logging in.');
        }

        if (Auth::guard('patient')->attempt($credentials)) {
            return redirect()->intended('/patient/home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect('/patient/login');
    }

    public function showRegisterForm()
    {
        return view('patient.register');
    }

   

   public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:20|unique:patients',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|unique:patients',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999); 
        $expiresAt = now()->addMinutes(10); // OTP expiry 10 minit

        // Create patient with OTP
        $patient = Patient::create([
            'name' => $request->name,
            'ic_number' => $request->ic_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,
            'is_verified' => 0,
        ]);


        // Hantar OTP guna email
        Mail::to($patient->email)->send(new SendOtpMail($otp));

        return redirect()->route('patient.otp.form', ['id' => $patient->id])
            ->with('success', 'Registration successful. Please check your email for the OTP.');
    }

    public function index()
    {
        $patient = Auth::guard('patient')->user();

        $latestQueue = $patient->queues()
            ->whereIn('phase', ['waiting', 'consultation', 'pharmacy'])
            ->latest()
            ->with('clinic')
            ->first();

        $clinics = Clinic::all();

        // Dapatkan giliran sedang diserve di klinik user
        $nowServing = null;
        if ($latestQueue) {
            $nowServing = Queue::where('clinic_id', $latestQueue->clinic_id)
                ->where('phase', 'consultation')
                ->orderBy('created_at')
                ->first();
        }

        return view('patient.home', compact('latestQueue', 'clinics', 'nowServing'));
    }

 
    public function history(Request $request)
    {
        $patient = Auth::guard('patient')->user();
        $query = $patient->queues()->with('clinic')->orderBy('created_at', 'desc');

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'today':
                    $query->whereDate('created_at', now());
                    break;
                case 'week':
                    $query->where('created_at', '>=', now()->subWeek());
                    break;
                case 'month':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
            }
        }

        if ($request->has('clinic_name') && $request->clinic_name !== '') {
            $query->whereHas('clinic', function ($q) use ($request) {
                $q->where('clinic_name', 'like', '%' . $request->clinic_name . '%');
            });
        }

        $history = $query->get();

        return view('patient.history', compact('history'));
    }

    public function settings()
    {
        $patient = Auth::guard('patient')->user();
        return view('patient.setting', compact('patient'));
    }

    public function updateSettings(Request $request)
    {
        $patient = Auth::guard('patient')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:20|unique:patients,ic_number,' . $patient->id . ',id',
            'dob' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|unique:patients,email,' . $patient->id . ',id',
        ]);

        $patient->update($request->all());

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function cancelQueue($id)
    {
        $patient = Auth::guard('patient')->user();

        $queue = $patient->queues()
            ->where('queue_id', $id)
            ->where('phase', 'waiting')
            ->first();

        if (!$queue) {
            return back()->with('error', 'Queue not found or cannot be cancelled.');
        }

        $queue->status = 'cancelled';
        $queue->save();

        return back()->with('success', 'Queue has been cancelled.');
    }

    public function showOtpForm($id)
    {
        $patient = Patient::findOrFail($id);
        return view('auth.verify_otp', [
            'id' => $id,
            'email' => $patient->email,
        ]);
    }

    public function verifyOtp(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $patient = Patient::findOrFail($id);

        if (
            $patient->otp === $request->otp &&
            now()->lessThanOrEqualTo($patient->otp_expires_at)
        ) {
            $patient->is_verified = 1;
            $patient->otp = null;
            $patient->otp_expires_at = null;
            $patient->save();

            return redirect()->route('patient.login')->with('success', 'Email successfully verified. You may now log in.');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    public function getNearbyClinics(Request $request)
{
    $latitude = $request->latitude;
    $longitude = $request->longitude;

    // Cari klinik dalam radius 20km guna formula Haversine
    $clinics = DB::table('clinics')
        ->select('*', DB::raw("(
            6371 * acos(
                cos(radians($latitude)) *
                cos(radians(latitude)) *
                cos(radians(longitude) - radians($longitude)) +
                sin(radians($latitude)) *
                sin(radians(latitude))
            )
        ) AS distance"))
        ->having('distance', '<=', 20)
        ->orderBy('distance')
        ->get();

    return response()->json($clinics);
}

}
