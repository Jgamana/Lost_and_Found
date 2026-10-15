<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return redirect()->route('landing');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:student,faculty',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.unique' => 'This email is already registered. Please use another email address.',
        ]);

        $code = (string) random_int(100000, 999999);

        session([
            'registration_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ],
        ]);

        session()->forget('verification_user_id');

        EmailVerification::where('email', $request->email)->delete();

        EmailVerification::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($request->email)
            ->send(new EmailVerificationCode($code));

        return redirect()
            ->route('verification.show')
            ->with(
                'success',
                'A 6-digit verification code has been sent to your email address.'
            );
    }
}
