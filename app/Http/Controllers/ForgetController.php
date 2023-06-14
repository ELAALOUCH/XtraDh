<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ForgotPasswordRequest;

class ForgetController extends Controller
{
    public function forgot(ForgotPasswordRequest $request){
        $email = $request->input('email');
        if(User::where('email',$email)->doesntExist()){
            return response([
                'message'=>'L\'utilisateur n\'existe pas'
            ],400);
        }
        $token = Str::random(30);
        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token
        ]);

        //send email
        Mail::send('Mails.forgot',['token'=>$token],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Réinitialiser votre mot de passe ');

        });

        try{
            return response([
                'message'=>'Consulter votre boîte mail'
            ]);
        }catch(\Exception $exeption){
            return response([
                'message'=>$exeption->getMessage()
            ],400);
        }
    }

    
    /** @var User $user */
    public function reset(ResetRequest $request){
        $token = $request->input('token');
        if(! $passwordResets = DB::table('password_resets')->where('token',$token)->first()){
            return response([
                'errors'=>'The token is invalid'
            ],400);
        }
        if(! $user = User::where('email',$passwordResets->email)->first()){
            return response([
                'message'=>'L\'utilisateur n\'existe pas'
            ],404);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response([
            'message'=>'success'
        ]);

    }
}
