<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentRegisterController extends Controller
{
    public function showRegistrationForm() 
    {
        return view('auth.register-mahasiswa');
    }

    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Calon mahasiswa
        ]);

        Auth::login($user);

        return redirect()->route('ekyc.step1')
                         ->with('success', 'Registration berhasil! Silahkan lengkapi data E-KYC anda'); // Redirect to student dashboard
    }
}
