<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:student,faculty',
            'password' => 'required|min:8|confirmed',
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->role === 'faculty'
                ? 'pending'
                : 'approved',
        ]);
        
        
        
        
       if ($user->role === 'faculty') {
            return redirect('/login')->with(
                'success',
                'Faculty registration submitted successfully. Your account is pending admin approval. Please wait until an administrator approves your account.'
            );
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/student/dashboard');

    }
}