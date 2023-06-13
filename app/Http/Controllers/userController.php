<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\administrateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\EnseignantController;
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
        return response()->json(User::all());
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
        //$fields['password']=Str::random(15);
        $fields['password'] = $request->password ; 

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
    public function storeProfEtb(Request $request)
    {
        //cette methode pour storer des enseignant dans etablissement de administrateur (automatiquement)
        $fields = $request->validate([
            'email' =>'required|email|unique:users,email',
            'type'=>'required'
        ]);
       $fields['password']=Str::random(15);
       //$fields['password'] = "1234";
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
        $request['id_user'] = $user->id_user;
        if(!isset($request->Etablissement))
            $request['Etablissement'] = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement;
        //create enseignant
         $ensctrl =  new EnseignantController();
        $ensctrl = $ensctrl->storeETB($request);
        $response= [
            'user'=>$user,
            'token' =>$token,
            'enseignant'=>$ensctrl
        ];
        return response()->json($response,202);
    }

    public function storeAdmEtb(Request $request)
    {
        //cette methode pour storer des administateur etablissement dans etablissement de administrateur (automatiquement)
        
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
        
        $email = $fields['email'];
        Mail::send('Mails.password',['password'=>$fields['password']],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Voici le mot de pass de votre compte hsup');
        });
         $token = $user->createToken('MyAppToken')->plainTextToken;
        $request['id_user'] = $user->id_user; 
        if(!isset($request->Etablissement))
            $request['Etablissement'] = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        //create enseignant
        $admctrl =  new AdministrateurController();
        $admctrl = $admctrl->storeETB($request);
        $response= [
            'user'=>$user,
            'token' =>$token,
            'admin'=>$admctrl
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
        $user = user::with(['administrateur'])
                     ->with(['enseignant'])
                     ->find($id)  ;
        if($user==null){
            return response()->json(['errors'=>'user not found'],404);
        }
        return response()->json($user,200);
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
        if($user==null){
            return response()->json(['errors'=>'user not found'],404);
        }
        $user->update($fields);

        $response= [
            'user'=>$user,
            'token' =>Auth::user()->tokens()
        ];
        return response()->json($response,202);

    }
    public function updateprof(Request $request,$id){
     
        $user = User::where('id_user',$id)->first();
        if($user==null){
            return response()->json(['errors'=>'user not found'],404);
        }

       if($request->email)
            $user->email = $request->email ;
       if($request->password)
            $user->password = bcrypt($request->password);
          $user->save();  

        //update enseignant
        $id = Enseignant::where('id_user',$user->id_user)->first();
        $ensctrl =  new EnseignantController();
        $ensctrl = $ensctrl->update($request,$id->id);   
        return response($ensctrl,202);
    }

    public function adminProfile()
    {   
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $user = Auth::user();
        $user = DB::table('administrateurs')
                    ->join('users', 'administrateurs.id_user', '=', 'users.id_user')
                    ->join('etablissements','administrateurs.Etablissement','=','etablissements.id')
                    ->select('users.id_user','users.email','users.type', 'administrateurs.Nom','administrateurs.prenom','administrateurs.PPR','etablissements.Nom as etab_Nom')
                    ->where('administrateurs.Etablissement',$etb)
                    ->where('users.id_user',$user->id_user)
                    ->first();
        return  response()->json($user) ;
   
  }
    public function profProfile()
    {   
        $etb = Enseignant::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $user = Auth::user();
        $user = DB::table('enseignants')
                    ->join('users', 'enseignants.id_user', '=', 'users.id_user')
                    ->join('etablissements','enseignants.Etablissement','=','etablissements.id')
                    ->select('users.id_user','users.email','users.type', 'enseignants.Nom','enseignants.prenom','enseignants.PPR','etablissements.Nom as etab_Nom')
                    ->where('enseignants.Etablissement',$etb)
                    ->where('users.id_user',$user->id_user)
                    ->first();
        return  response()->json($user) ;
   
  }

    public function updateAdm(Request $req,$id){
        //$id = $req->id;
        $adm = user::where('id_user',$id)->first();
        if($adm==null){
            return response()->json(['errors'=>'user not found'],404);
        }

        if($req->email)
            $adm->email = $req->email ;
        if($req->password)
            $adm->password = bcrypt($req->password);
        $adm->save(); 
        $id=Administrateur::where('id_user',$adm->id_user)->first();
        $adm_cntrol = new AdministrateurController();
        $adm_cntrol = $adm_cntrol->update($req,$id->id);
        return response()->json($adm_cntrol,202);
    }

    public function ajoutinterventionetab(Request $request)
    {
        $user = Auth::user();
        $etb = administrateur::where('id_user',$user->id_user)->select('Etablissement')->first();
        $request["id_etab"] = $etb->Etablissement;
        $ensctrl =  new InterventionController();
        $ensctrl = $ensctrl->storePPR($request); 
        return response()->json($ensctrl,201);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyprof($id){
        $user = User::find($id);
        if($user==null){
            return response()->json(['errors'=>'user not found'],404);
        }
         $ens = Enseignant::where('id_user',$user->id_user)->first()->delete();   
         return response()->json($user->delete(),202);
    }
    public function destroyAdmin($id){
        $user = User::find($id);
        if($user==null){
            return response()->json(['errors'=>'user not found'],404);
        }
         $ens = Administrateur::where('id_user',$user->id_user)->first()->delete();
         return response()->json($user->delete(),202);
    }



    public function destroy($id)
    {
        return User::find($id)->delete();

    }
}
