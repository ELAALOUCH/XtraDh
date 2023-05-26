<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EnseignantController;
use App\Models\administrateur;
use App\Models\Enseignant;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\User as Authenticatable;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
    //$this->middleware('auth:sanctum')->except(['store']);
    }

    public function index()
    {
        return User::with(['administrateur'])
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
            'type'=>'required'
        ]);
        $fields['password']=Str::random(15);

        $user = User::create([
            'type' =>$fields['type'],
            'email' => $fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
       // 'email' => Crypt::encrypt($fields['email']),
     //   $email = Crypt::decrypt($fields['email']);
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
    public function storeProfEtb(Request $request)
    {
        //return $request;
        //cette methode pour storer des enseignant dans etablissement de administrateur (automatiquement)
        $fields = $request->validate([
            'email' =>'required|email|unique:users,email',
            'type'=>'required'
        ]);
        $fields['password']=Str::random(15);
       // return $fields;
        $user = User::create([
            'type' =>$fields['type'],
            'email' => $fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
       // return $user;
       // 'email' => Crypt::encrypt($fields['email']),
     //   $email = Crypt::decrypt($fields['email']);
       $email = $fields['email'];
        Mail::send('Mails.password',['password'=>$fields['password']],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Voici le mot de pass de votre compte hsup');
        });
         $token = $user->createToken('MyAppToken')->plainTextToken;
        $request['id_user'] = $user->id_user;
        $request['Etablissement'] = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        //create enseignant
         $ensctrl =  new EnseignantController();
        $ensctrl = $ensctrl->storeETB($request);
        $response= [
            'user'=>$user,
            'token' =>$token,
            'enseignant'=>$ensctrl
        ];
        return response($response,202);
    }

    public function storeAdmEtb(Request $request)
    {
        //cette methode pour storer des enseignant dans etablissement de administrateur (automatiquement)
        return $request;
        $fields = $request->validate([
            'email' =>'required|email|unique:users,email',
            'type'=>'required'
        ]);
             $fields['password']=Str::random(15);

        $user = User::create([
            'type' =>$fields['type'],
            'email' => $fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        return $user;
       // 'email' => Crypt::encrypt($fields['email']),
     //   $email = Crypt::decrypt($fields['email']);
      /* $email = $fields['email'];
        Mail::send('Mails.password',['password'=>$fields['password']],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Voici le mot de pass de votre compte hsup');
        });*/
         $token = $user->createToken('MyAppToken')->plainTextToken;
        $request['id_user'] = $user->id_user;
        $request['Etablissement'] = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        //create enseignant
        return $request;
         $ensctrl =  new AdministrateurController();
        $ensctrl = $ensctrl->storeETB($request);
        $response= [
            'user'=>$user,
            'token' =>$token,
            'enseignant'=>$ensctrl
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
            user::with(['administrateur'])
                ->with(['enseignant'])
                ->find($id)    
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
            'email' =>'email',
            'password' =>'string',
            'type'=>'string'
        ]);


        $user = user::find($id);
        $user->update($fields);
        //$token = $user->createToken('MyAppToken')->plainTextToken;
        $response= [
            'user'=>$user,
            'token' =>Auth::user()->tokens()
        ];
        return response($response,202);

    }
    public function updateprof(Request $request,$id){
     
        $user = User::where('id_user',$id)->first();
         $user->update($request->only(['email','password','type']));
        //create enseignant
        $id = Enseignant::where('id_user',$user->id_user)->first();
        $ensctrl =  new EnseignantController();
        return $ensctrl = $ensctrl->update($request,$id->id);   
    }
    public function updateAdm(Request $req,$id){
        $adm = user::where('id_user',$id)->first();
            $adm->update($req->only(['email','password','type']));

            $id=Administrateur::where('id_user',$adm->id_user)->first();
            $adm_cntrol = new AdministrateurController();
            return $adm_cntrol->update($req,$id->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyprof($id){
        $user = User::find($id);
         $ens = Enseignant::where('id_user',$user->id_user)->first()->delete();
         return $user->delete(); 
    }
    public function destroyAdmin($id){
        $user = User::find($id);
         $ens = Administrateur::where('id_user',$user->id_user)->first()->delete();
         return $user->delete(); 
    }



    public function destroy($id)
    {
        return User::find($id)->delete();

    }
}
