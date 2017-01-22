<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('login');
    }
    
    public function verifyUser(Request $request){
        if($request->isMethod('POST')){
            if(Auth::attempt([
                'email' => $request->get('email'), 
                'password' => $request->get('password')
                        ])){
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('err', '<div class="alert alert-danger">Failed Login</div>');
            }
        }
        return redirect('/');
    }
    
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
