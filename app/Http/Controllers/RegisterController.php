<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        $userType = $request->is('register/tutor') ? 'tutor' : 'student'; // Determine user_type based on URL
        
        return view('auth.register', compact('userType'));  // Pass user_type to the view
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $createdBy = Auth::id();
        // Create the user with the correct role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->user_type,
            'created_by' => $createdBy, // Use the passed user_type from the form
        ]);

        // Assign the role based on the user type
        if ($request->user_type == 'tutor') {
            $user->assignRole('tutor');
        } else {
            $user->assignRole('student');
        }

        return redirect()->route('home');
    }
}
