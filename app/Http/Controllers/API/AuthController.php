<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($data)){
            $user = Auth::user();
            $success = [];
            $success['token'] = $user->createToken('myApp')->accessToken;
            return response()->json(['succeess' => $success], 200);
        }else{
            return response()->json(['succeess' => 'Unauthorised'], 200);

        }
    }

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirmation']);
        $user = User::create($data);
        $success = [];
        $success['token'] = $user->createToken('myApp')->accessToken;
        $success['name']  =  $user->name;
        return response()->json(['success' => $success], 200);
    }

    public function details(){
        $user = Auth::user();
        return response()->json(['details' => $user], 200);

    }
}
