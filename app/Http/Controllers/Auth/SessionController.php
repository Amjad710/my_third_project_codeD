<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionController extends Controller
{
    
    public function create()
    {
        return view('auth.log-in');
    }

    public function store(Request $request)
    {
        //validate the request
    $validated =$request->validate([
        'email'=>['required','string','email','max:256'],
        'password'=>['required',Password::default()],
    ]);

    //attempt to login
    if (Auth::attempt($validated)) {
        $request->session()->regenerate();
        return redirect('/ideas');
    }

    return back()->withErrors([
        'email'=>'the credensials do not match our records'
    ]);
    
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/ideas');
    }
}
