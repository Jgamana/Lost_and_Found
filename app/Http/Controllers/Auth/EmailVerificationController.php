<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerificationCode;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function show()
    {
        if (!session()->has('verification_user_id')) {
            return redirect('/register');
        }

        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = session('verification_user_id');

        $verification = EmailVerification::where(
            'user_id',
            $userId
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

        $user = $verification->user;

        $user->update([
            'email_verified_at' => now(),
        ]);

        $verification->delete();

        session()->forget('verification_user_id');

        if ($user->role === 'faculty') {
            return redirect('/login')->with(
                'success',
                'Email verified successfully. Your faculty account is now pending admin approval.'
            );
        }

        auth()->login($user);

        $request->session()->regenerate();

        return view('auth.verification-success');
    }

    public function resend()
    {
        $userId = session('verification_user_id');

        if (!$userId) {
            return redirect('/register');
        }

        $verification = EmailVerification::where(
            'user_id',
            $userId
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

        Mail::to($verification->user->email)
            ->send(new EmailVerificationCode($code));

        return back()->with(
            'success',
            'A new verification code has been sent to your email.'
        );
    }
}