<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard page
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Show student registration form
    public function showStudentRegistrationForm()
    {
        return view('admin.register.student');
    }

    // Show admin registration form
    public function showAdminRegistrationForm()
    {
        return view('admin.register.admin');
    }

    // Store student registration
    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Automatically assign student role
        ]);

        // Optionally, use roles if you're using a package like Spatie
        $user->assignRole('student');
        
        return redirect()->route('admin.dashboard')->with('success', 'Student registered successfully!');
    }

    // Store admin registration
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Automatically assign admin role
        ]);

        // Optionally, use roles if you're using a package like Spatie
        $user->assignRole('admin');
        
        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully!');
    }
}
