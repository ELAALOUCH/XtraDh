<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return user::with(['administrateur'])
                    ->with(['enseignant'])
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $fields = $request->validate([
            'email' =>'required|email|unique:users,email',
            'password' =>'string|confirmed|required',
            'type'=>'required'
        ]);
        $fields['password']=Str::random(15);
        $user = User::create([
            'type' =>$fields['type'],
            'email' => $fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        $email = $fields['email'];
        Mail::send('Mails.password',['password'=>$fields['password']],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Voici le mot de pass de votre compte hsup');
        });
        $token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token' =>$token
        ];
        return response($response,202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            user::find($id)
                ->with(['administrateur'])
                ->with(['enseignant'])
                ->get()    
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $fields = $request->validate([
            'email' =>'required|email',
            'password' =>'string|confirmed|required',
            'type'=>'required'
        ]);


        $user = user::find($id);
        $user->update($fields);
        //$token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token' =>Auth::user()->currentAccessToken()
        ];
        return response($response,202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return user::find($id)->delete();

    }
}
