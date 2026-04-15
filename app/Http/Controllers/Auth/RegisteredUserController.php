<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(Request $request){
    //validate the request
    $request->validate([
        'name'=>['required', 'string'],
        'email'=>['required','string','email','max:256','unique:users'],
        'password'=>['required',Password::default()],
    ]);
    //create the user in the DB
    $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
    ]);
    //log them in
    Auth::login($user);
    //redirct home
    return redirect('/ideas');
    }
}
