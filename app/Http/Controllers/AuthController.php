<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{


    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password);
        $user->role = $request->role;
        Log::info('User created: '.$user);
        $user->save();


        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('token', $token, 60*24); // 1 day
            return response(["token"=>$token], Response::HTTP_OK)->withoutCookie($cookie);
        }else{
            return response(["error"=>"Invalid credentials"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function userProfile(Request $request) {
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }

        public function logout() {
            $cookie = Cookie::forget('token');
            return response(["message"=>"session closed"], Response::HTTP_OK)->withCookie($cookie);
        }
}
