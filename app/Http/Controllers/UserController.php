<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function __invoke()
    {
    }

    function login_view()
    {
        return view("user");
    }

    function login(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'The password is incorrect'
        ])->onlyInput('password');
    }

    function register_view()
    {
        return view("register");
    }

    function register(Request $request)
    {

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
            'name' => $username,
            'bandname' => $bandname,
            'email' => $email,
            'password' => $password,
            'logo' => $file_name
        ]);

        return redirect()->route('home');

    }

    function remind_view()
    {
        return view("forgot");
    }

    function send_mail(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|max:25|email',
        ]);

        // Buscar al usuario por su correo electrónico
        $usuario = User::where('email', $request->email)->first();

        if ($usuario) {
            // Si se encuentra el usuario, obtén su contraseña
            $pass = $usuario->password;
            $user = $usuario->name;
            // Envía el correo electrónico con la contraseña al usuario
            Mail::to($request->email)->send(new ContactoMailable($pass, $user));
        } else {
            return view("forgot")->with('error', 'User not found. Check the email.');
        }

        return view("forgot")->with('success', 'Email sent. Check the inbox.');;
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
