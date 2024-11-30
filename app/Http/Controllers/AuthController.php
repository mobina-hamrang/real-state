<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'phone' => 'required|iran_mobile:true',
        ],[
            'phone.required' => 'phone number is required',
        ])->errors()->jsonSerialize());

        if (!$errors) {
            $credentials = $request->only('phone');
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = Auth::user();
            $session = Session::updateOrCreate([
                'token'=> $token,
                'user_id'=>$user->user_id
            ]);

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }

    public function register(Request $request){
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|iran_mobile:true|max:255|unique:users',
            'password' => 'string|min:6',
        ],[
            'name.required' => 'name is required',
            'phone.required' => 'phone number is required',
            'phone.unique' => 'phone number had been used',
            'password.min' => 'password must be at least 6 characters',
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('User');

            $token = Auth::login($user);
            $session = Session::create([
                'token'=> $token,
                'user_id'=>$user->user_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        $token = Auth::refresh();
        Session::updateOrCreate(['token'=>$token]);

        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

}
