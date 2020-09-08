<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApiResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request -> validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required' , 'string', 'email', 'max:255', 'unique:users'],
            'photo_url' => ['string'],
            'password' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'string'],
        ]);


            $user = new User();
            $user -> first_name = $request->input('first_name');
            $user -> last_name = $request->input('last_name');
            $user -> email = $request->input('email');
            $user -> photo_url = $request->input('photo_url');
            $user -> password  = Hash::make($request->input('password'));
            $user -> mobile = $request->input('mobile');
            $user -> api_token = bin2hex(openssl_random_pseudo_bytes(30));

            $user -> save();


            return new UserApiResource($user);
    }


    public function login(Request $request){

        $request -> validate([
            'email' => ['required' , 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        $email = $request->input('email');
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $user = User::where('email' , $email)->first();

            return new UserApiResource($user);
        }
        $message =  [
            'error' => true,
            'message' => ' login data is error',
        ];
        return response($message , 404 );


    }
}
