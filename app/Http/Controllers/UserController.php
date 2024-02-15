<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __invoke(){}

    function login_view(){
        return view("user");
    }

    function login(Request $request){

        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'The password is incorrect'
        ])->onlyInput('password');
    }

    function register_view(){
        return view("register");
    }

    function register(Request $request){

        $this->validate($request, [
            'bandname' => 'required|min:3|max:15',
            'email' => 'required|max:25|email|unique:users,email',
            'username' => 'required|min:5|max:15|unique:users,name',
            'password' => 'required|min:6|confirmed',     
        ]);

        $file = $request->file('user_img');
        $destinationPath = "uploads/users";

        if ($file) {
            $file_name = $file->getClientOriginalName();
            if ($file->move($destinationPath, $file_name)) {
                echo "Update success";
            } else {
                echo "Update failed";
            }
        } else {
            $file_name = "default_img.png";
            echo "No file uploaded.";
        }

        $bandname = $request->get('bandname');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        User::create([
            'name'=>$username,
            'bandname'=>$bandname,
            'email'=>$email,
            'password'=>$password,
            'logo'=>$file_name
        ]);

        return redirect()->route('home');

    }

    function logout(){
        auth()->logout();
        return redirect()->route('home');
    }
}
