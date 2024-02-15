<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|unique:users,name',
                'email' => 'required|min:4|unique:users,email',
                'bandname' => 'required|min:4',
                'password' => 'required|min:4',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bandname' => $request->bandname,
                'password' => $request->password,
            ]);
        }

        if ($user->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => "Usuario añadido correctamente",
                'token' => $user->createToken('API Token')->plainTextToken
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'name' => 'Algo ha ido mal'
            ], 500);
        }
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['name', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'El usuario y contraseña no coinciden.',
            ], 401);
        }

        $user = User::where('name', $request->name)->first();

        return response()->json([
            'status' => true,
            'message' => 'Estás logeado, bienvenido ' . $user->name,
            'token' => $user->createToken("API Token")->plainTextToken
        ], 200);
    } 

}
