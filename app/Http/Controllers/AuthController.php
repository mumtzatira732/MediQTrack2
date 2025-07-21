<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        return view('auth.verify-email', ['email' => session('email')]);
    }

    public function verifyEmailCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $user = User::where('email', $request->email)
                    ->where('email_verification_code', $request->otp)
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid code.']);
        }

        $user->is_verified = true;
        $user->email_verification_code = null; // clear code after verification
        $user->save();

        return redirect()->route('login')->with('success', 'Your email has been verified! You can now log in.');
    }
}

