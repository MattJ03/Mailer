<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:5|max:20'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email'=> $validatedData['email'],
            'password' => Hash::make('password'),
        ]);

        Auth::login($user);

        Mail::to($user)->send(new WelcomeMail($user->email));

        return redirect('/login');
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:5|max:20',
        ]);
        if(!Auth::attempt($request->only('email', 'password'))) {
          return redirect('/login');
        }
        return redirect('tasks.index');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
