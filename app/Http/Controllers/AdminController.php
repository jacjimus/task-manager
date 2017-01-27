<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    /*
     * This method is the entry point to the application,
     * It loads and displays the login screen to the user
     */
    public function login(){
        return view('login');
    }
    
    /*
     * This method executes the login verification , If user is 
     * authetic , The user is redirected to the dashboard else
     * the user is re-routed back to the login screen
     */
    public function auth(Request $request){
        if($request->isMethod('POST')){
            if(Auth::attempt([
                'email' => $request->get('email'), 
                'password' => $request->get('password')
                        ])){
                return redirect('/dashboard');
            } else {
                return redirect('/')->with('err', '<div class="alert alert-danger">Incorrect Username/Password</div>');
            }
        }
        return redirect('/');
    }
    
    /*
     * the logout method. User is exitted out of the application
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
