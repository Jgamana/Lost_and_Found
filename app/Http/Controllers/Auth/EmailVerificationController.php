<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function show()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('landing');
        }

        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $registrationData = session('registration_data');

        if (!$registrationData) {
            return redirect()
                ->route('landing')
                ->withErrors([
                    'email' => 'Registration session expired. Please register again.',
                ]);
        }

        $verification = EmailVerification::where(
            'email',
            $registrationData['email']
        )->first();

        if (!$verification) {
            return back()->withErrors([
                'code' => 'Verification code not found. Please request a new code.',
            ]);
        }

        if ($verification->expires_at->isPast()) {
            return back()->withErrors([
                'code' => 'Verification code has expired. Please request a new code.',
            ]);
        }

        if ($verification->code !== $request->code) {
            return back()->withErrors([
                'code' => 'Invalid verification code.',
            ]);
        }

        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'role' => $registrationData['role'],
            'status' => $registrationData['role'] === 'faculty'
                ? 'pending'
                : 'approved',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $verification->delete();

        session()->forget('registration_data');

        if ($user->role === 'faculty') {
            return redirect()
                ->route('landing')
                ->with('success', 'Email verified successfully. Your faculty account is now pending admin approval.')
                ->with('auth_form', 'login');
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('student.dashboard');
    }

    public function resend()
    {
        $registrationData = session('registration_data');

        if (!$registrationData) {
            return redirect()->route('landing');
        }

        $verification = EmailVerification::where(
            'email',
            $registrationData['email']
        )->first();

        if (!$verification) {
            return back()->withErrors([
                'code' => 'Verification request not found.',
            ]);
        }

        $code = (string) random_int(100000, 999999);

        $verification->update([
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($registrationData['email'])
            ->send(new EmailVerificationCode($code));

        return back()->with(
            'success',
            'A new verification code has been sent to your email.'
        );
    }
}