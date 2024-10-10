<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $req)
    {
        $validation = $req->validate([
            'uname'=>'required|string|max:255|not_regex:/.+\-.+/i',
            'uuname'=>'required|string|alpha|max:255',
            'umail'=>'required|email|max:255|unique:'.User::class.',email',
            'upwd'=>['string','required','max:32',Rules\Password::defaults()],
            'upwd2'=>['string','required','max:32',Rules\Password::defaults()],
            'ustatus'=>'string|required'
        ]);
        $newuser = User::create(array(
            'name'=>$req->input('uname'),
            'email'=>$req->input('umail'),
            'password'=>Hash::make($req->input('upwd')),
            'uname'=>$req->input('uuname'),
            'status'=>$req->input('ustatus')
        ));
        // Check if newuser was created here

        event(new Registered($newuser));
        Auth::login($newuser);
        return redirect()->route('user.show');
    }
}
