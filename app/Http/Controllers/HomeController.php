<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class HomeController extends Controller
{
    function index(){
        $products = Product::all();
        return view('frontend.index',[
            'products' => $products,
        ]);
    }

    function dashboard(){
        return view('dashboard.dashboard');
    }

    function register(){
        return view('dashboard.register');
    }

    function store_register(Request $request){
        $request->validate([
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);
        
        if($request->password != $request->confirm_password){
            return back()->with('wrong', "Password doesn't match!");
        }
        else{
                User::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon::now(),
                ]);
            return back()->with('success', "You have registered successfully!!");
        }
    }

    function login(){
        return view('dashboard.login');
    }

    function login_post(Request $request){
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        if(User::where('email', $request->email)->exists()){
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return redirect()->route('dashboard')->with('logged', "You're logged in!!");
            }
            else{
                return back()->with('wrong', 'Wrong credential.');
            }
        }
        else{
        
            return back()->with('exists', 'Email does not exists.');
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login');

    }
}
