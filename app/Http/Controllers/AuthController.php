<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request){
        $fields = $request->validate([
            'email' =>'required|email',
            'password' =>'string|required'
        ]);
        //check email
            $user = User::where('email',$fields['email'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message' => 'Email or Password are incorrect'
            ],401);
        }
                $token = $user->createToken('MyAppToken')->plainTextToken;
                $response= [
                    'user'=>$user,
                    'token' =>$token
                ];
                return response($response,202);
    }

    public function userProfile(){
        return response()->json(auth()->user());

    }

    public function logout(Request $request)
{
    $user = auth()->user();

    if ($user) {
        $user->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }


}


}
