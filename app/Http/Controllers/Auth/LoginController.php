<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return match ($user->role) {
                'student' => redirect()->route('student.dashboard'),
                'faculty' => redirect()->route('faculty.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
                default => redirect()->route('login'),
            };
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            /*
            |--------------------------------------------------------------------------
            | Deactivated Account
            |--------------------------------------------------------------------------
            */

            if (!$user->is_active) {

                ActivityLog::record(
                    'Failed Login',
                    'Deactivated account attempted to log in: ' . $user->email
                );

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Your account has been deactivated. Please contact the administrator.',
                    ])
                    ->onlyInput('email');
            }

            /*
            |--------------------------------------------------------------------------
            | Pending Faculty
            |--------------------------------------------------------------------------
            */

            if (
                $user->role === 'faculty' &&
                $user->status === 'pending'
            ) {

                ActivityLog::record(
                    'Failed Login',
                    'Pending faculty account attempted to log in: ' . $user->email
                );

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Your faculty account is pending admin approval. Please wait until an administrator approves your account.',
                    ])
                    ->onlyInput('email');
            }

            /*
            |--------------------------------------------------------------------------
            | Rejected Faculty
            |--------------------------------------------------------------------------
            */

            if (
                $user->role === 'faculty' &&
                $user->status === 'rejected'
            ) {

                ActivityLog::record(
                    'Failed Login',
                    'Rejected faculty account attempted to log in: ' . $user->email
                );

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Your faculty account registration was rejected by the administrator.',
                    ])
                    ->onlyInput('email');
            }

            /*
            |--------------------------------------------------------------------------
            | Other Unapproved Accounts
            |--------------------------------------------------------------------------
            */

            if ($user->status !== 'approved') {

                ActivityLog::record(
                    'Failed Login',
                    'Unapproved account attempted to log in: ' . $user->email
                );

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Your account is not currently approved.',
                    ])
                    ->onlyInput('email');
            }

            /*
            |--------------------------------------------------------------------------
            | Successful Login
            |--------------------------------------------------------------------------
            */

            $request->session()->regenerate();

            ActivityLog::record(
                'Login',
                'User logged in successfully.'
            );

            /*
            |--------------------------------------------------------------------------
            | Redirect Based on Role
            |--------------------------------------------------------------------------
            */

            if ($user->role === 'student') {
                return redirect()->route('student.dashboard');
            }

            if ($user->role === 'faculty') {
                return redirect()->route('faculty.dashboard');
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Invalid Email or Password
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'Failed Login',
            'Failed login attempt for email: ' . $request->email
        );

        return back()
            ->withErrors([
                'email' => 'The provided email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        if (Auth::check()) {
            ActivityLog::record(
                'Logout',
                'User logged out successfully.'
            );
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}