<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

   public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $patient = Patient::where('google_id', $googleUser->getId())->first();

        if (!$patient) {
            $patient = Patient::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
                'ic_number' => '000000000000', // sementara sebab column tak nullable
            ]);
        }

        Auth::guard('patient')->login($patient);
        return redirect()->intended('/patient/home');

    } catch (\Exception $e) {
        Log::error('Google Login Error: ' . $e->getMessage());
        return redirect('/patient/login')->with('error', 'Google Login failed.');
    }
}
}


