<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'string|required',
            'email' =>'required|email|unique:users,email',
            'password' =>'string|confirmed|required'
        ]);
        $user = User::create([
            'name' =>$fields['name'],
            'email' => encrypt( $fields['email']),
            'password'=>bcrypt($fields['password'])
        ]);
        $token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token' =>$token
        ];
        return response($response,202);
    }

    public function login(Request $request){
        $fields = $request->validate([
            decrypt('email') =>'required|email',
            'password' =>'string|required'
        ]);
//check email
    $user = User::where('email',$fields['email'])->first();
//check password
if(!$user || !Hash::check($fields['password'],$user->password)){
    return response([
        'message' => 'Email or Password are incorrect'
    ],404);
}


        $token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token' =>$token
        ];
        return response($response,202);
    }


public function userProfile(){
    return response()->json(auth()->user);
}




    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' =>'Logged out'
        ];
    }





}

