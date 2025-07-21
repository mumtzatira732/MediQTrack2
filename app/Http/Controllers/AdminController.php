<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

use App\Mail\ClinicApprovedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClinicRejectedMail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only('dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login', [
            'title' => 'Admin Login',
            'action' => route('admin.login'),
            'registerLink' => null
        ]);
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    logger()->info('LOGIN REQUEST', $credentials);

    if (Auth::guard('admin')->attempt($credentials)) {
    logger()->info('LOGIN SUCCESS', ['user' => Auth::guard('admin')->user()]);

    //dd('Logged in as: ', Auth::guard('admin')->user());
    return redirect('/admin/dashboard');
}
    logger()->warning('LOGIN FAILED');

    return back()->withErrors(['email' => 'Invalid credentials']);
}

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/admin/login');
    }

    public function dashboard()
    {
        $totalPatients = Patient::count();
        $totalClinics = Clinic::count();
        $todayQueues = Queue::whereDate('created_at', today())->count();
        $totalQueues = Queue::count();
        $activeQueues = Queue::where('phase', '!=', 'completed')->count();
        $completedQueues = Queue::where('phase', 'completed')->count();
        $consultationPhase = Queue::where('phase', 'consultation')->count();
        $pharmacyPhase = Queue::where('phase', 'pharmacy')->count();
        $completedPhase = Queue::where('phase', 'completed')->count();

        $mostActiveClinic = Clinic::select('clinic_name', DB::raw('COUNT(queues.queue_id) as total'))
            ->join('queues', 'clinics.clinic_id', '=', 'queues.clinic_id')
            ->groupBy('clinics.clinic_name')
            ->orderByDesc('total')
            ->first();

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalClinics',
            'todayQueues',
            'totalQueues',
            'activeQueues',
            'completedQueues',
            'consultationPhase',
            'pharmacyPhase',
            'completedPhase',
            'mostActiveClinic'
        ));

        dd(Auth::guard('admin')->user());
    }

    //UNTUK MANAGE USER/PATIENT

    public function manageUsers()
    {
        $users = Patient::all(); // anda guna Patient sebagai user
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function viewUser($id)
    {
        $user = Patient::findOrFail($id);
        return view('admin.users.view', compact('user'));
    }

   // Show Edit Form
    public function editUser($id)
    {
        $user = Patient::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'gender' => 'required|in:male,female',
            'ic_number' => 'required|string|max:20|unique:patients,ic_number',
            'dob' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'ic_number' => $request->ic_number,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    }

    // Handle Update
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:20',
            'dob' => 'required|date',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:6',
        ]);

        $user = Patient::findOrFail($id);

        $user->name = $request->name;
        $user->ic_number = $request->ic_number;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;

        // Hanya kemaskini password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = Patient::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    //UNTUK MANAGE CLINIC

    public function manageClinics()
    {
        $clinics = Clinic::where('is_approved', true)->get();
        return view('admin.clinics.index', compact('clinics'));
    }

    public function viewClinic($id)
    {
        $clinic = \App\Models\Clinic::findOrFail($id);
        return view('admin.clinics.view', compact('clinic'));
    }

    public function editClinic($id)
    {
        $clinic = Clinic::findOrFail($id);
        return view('admin.clinics.edit', compact('clinic'));
    }

    public function updateClinic(Request $request, $id)
    {
        $clinic = Clinic::where('clinic_id', $id)->firstOrFail();

        $clinic->clinic_name = $request->clinic_name;
        $clinic->email = $request->email;
        $clinic->phone = $request->phone;
        $clinic->latitude = $request->latitude;
        $clinic->longitude = $request->longitude;
        $clinic->radius = $request->radius;
        $clinic->license_no = $request->license_no;
        $clinic->is_approved = $request->is_approved;

        if ($request->password) {
            $clinic->password = Hash::make($request->password);
        }

        // License file (optional)
        if ($request->hasFile('license_file')) {
            $file = $request->file('license_file');
            $path = $file->store('licenses', 'public');
            $clinic->license_file = $path;
        }

        $clinic->save();

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic updated successfully.');
    }

    public function deleteClinic($id)
    {
        Clinic::where('clinic_id', $id)->delete();

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic deleted successfully.');
    }

    public function createClinic()
    {
        return view('admin.clinics.create');
    }

    public function storeClinic(Request $request)
    {
        $request->validate([
            'clinic_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clinics,email',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required|numeric',
            'phone'         => 'required|string|max:20',
            'license_no'    => 'required|string|max:100',
            'license_file'  => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:6',
        ]);

        // Simpan fail
        $path = $request->file('license_file')->store('licenses', 'public');

        Clinic::create([
            'clinic_name' => $request->clinic_name,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'phone'         => $request->phone,
            'license_no'    => $request->license_no,
            'license_file'  => $path,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic added successfully!');
    }

    public function pendingClinics()
    {
        // Update sini
        $clinics = Clinic::where('is_approved', 0)->get(); // hanya yang pending
        return view('admin.clinics.pending', compact('clinics'));
    }
    
   public function approveClinic($id)
{
    $clinic = Clinic::findOrFail($id);

    $clinic->is_approved = 1;
    $clinic->save();

    // Debug semak email
    if (!$clinic->email) {
        dd('Email klinik kosong!');
    }

    Mail::to($clinic->email)->send(new ClinicApprovedMail($clinic));

    return redirect()->route('admin.clinics.index')->with('success', 'Clinic approved and email sent.');
}

    public function rejectClinic($id)
{
    $clinic = Clinic::findOrFail($id);
    $clinic->is_approved = 2; // 2 = rejected
    $clinic->save();

    // Optional: hantar email makluman
    Mail::to($clinic->email)->send(new ClinicRejectedMail($clinic));

    return redirect()->back()->with('success', 'Clinic rejected successfully.');
}
}
