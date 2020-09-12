<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use App\User;
use Hash;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $login = Auth::attempt($credentials);

        if ($login) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('login');
        }

    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name'  => 'required|min:5|string',
        //     'email' => 'email|required',
        //     'password' => 'required|confirmed|min:6'
        // ]);
        $validasi = Validator::make($request->all(), [
            'name'  => 'required|min:5|string',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6'
        ])->validate();

        // if ($validasi->fails()) {
        //     return redirect()->route('register')->wi
        // }

        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        $user = User::create($request->all());
        
        if ( $user ) {
            return redirect()->route('login');
        } else {
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        $logout = Auth::logout();
        if ($logout) {
            redirect()->route('login');
        } else {
            abort(500);
        }
    }

}
