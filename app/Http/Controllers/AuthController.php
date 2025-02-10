<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' = 'required|string',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:5|max:20'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email'=> $validatedData['email'],
            'password' => Hash::make('password'),
        ]);
        Mail::to($user->email)->send(new Mail\WelcomeMail($user));
    }
}
