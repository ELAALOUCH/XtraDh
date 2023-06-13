<?php

namespace App\Http\Controllers;

use App\Models\enseignant;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdministrateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*$adm = administrateur::with('etablissement')->get();
        return $adm;*/
        $adm = Administrateur::with('user')
                              ->with('Etablissement')
                              ->get();

        return $adm;
    }

    public function listeAdminETBforadminuae()
    {
        $adm = DB::table('administrateurs')
                  ->join('users','administrateurs.id_user','=','users.id_user')      
                  ->join('etablissements','etablissements.id','=','Etablissement')
                  ->select('users.id_user as id','users.email','users.type','PPR','administrateurs.Nom as Nom','etablissements.Nom as etab_Nom','administrateurs.prenom')
                  ->where('users.type','admin_etb')
                  ->orderBy('administrateurs.id')
                ->get();
                return response()->json($adm) ;
    }
    public function listepresidentuaeforadminuae()
    {
        $adm = DB::table('administrateurs')
                  ->join('users','administrateurs.id_user','=','users.id_user')      
                  ->join('etablissements','etablissements.id','=','Etablissement')
                  ->select('users.id_user as id','users.email','users.type','PPR','administrateurs.Nom as Nom','etablissements.Nom as etab_Nom','administrateurs.prenom')
                  ->where('users.type','president_univ')
                  ->orderBy('administrateurs.id')
                ->get();
                return response()->json($adm) ;
    }
    public function listedirecteuretbforadminuae()
    {
        $adm = DB::table('administrateurs')
                  ->join('users','administrateurs.id_user','=','users.id_user')      
                  ->join('etablissements','etablissements.id','=','Etablissement')
                  ->select('users.id_user as id','users.email','users.type','PPR','administrateurs.Nom as Nom','etablissements.Nom as etab_Nom','administrateurs.prenom')
                  ->where('users.type','directeur_etb')
                  ->orderBy('administrateurs.id')
                ->get();
                return response()->json($adm) ;
             
    }



    public function directeurETB(){
        //cette methode est pour afficher la liste des directeur  qui appartient à etablissement de admistrateur 
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 

        $users = DB::table('administrateurs')
            ->join('users', 'administrateurs.id_user', '=', 'users.id_user')
            ->join('etablissements','administrateurs.Etablissement','=','etablissements.id')
            ->select('users.id_user','users.email','users.type', 'administrateurs.Nom','administrateurs.prenom','administrateurs.PPR','etablissements.Nom as etab_Nom')
            ->where('administrateurs.Etablissement',$etb)
            ->where('users.type','directeur_etb')
            ->orderBy('administrateurs.id')
            ->get();
      
        return  response()->json($users) ;
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributs = $request->validate([
            'PPR'=>'required',
            'Nom'=>'required',
            'prenom'=>'required',
            'Etablissement'=>'required',
            'id_user'=>'required'
        ]);
    //    $attributs['PPR']=Crypt::encrypt($attributs->PPR);
        $adm = Administrateur::Create($attributs);
        return response()->json($adm);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */

    public function storeETB(Request $request)
    {
        //cette methode pour storer des enseignant dans etablissement de admin (automatiquement)
        // Validation des champs
        $validator = Validator::make($request->all(), [
            'PPR' => 'required',
            'Nom' => 'required|max:30',
            'prenom' => 'required|max:30',
            'Etablissement' => 'required',
            'id_user' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Cryptage du champ PPR
       // $encryptedPPR = Crypt::encrypt($request->input('PPR'));
    
        // Création de l'enseignant
        $administrateur = Administrateur::create([
            'PPR' => $request->input('PPR'),
            'Nom' => $request->input('Nom'),
            'prenom' => $request->input('prenom'),
            'Etablissement' => $request["Etablissement"],
            'id_user' => $request["id_user"],
        ]);
        return $administrateur;
        //return response()->json(['message' => 'Enseignant créé avec succès'], 201);
    }
    public function show($id)
    {
        $user = DB::table('administrateurs')
                    ->join('users', 'administrateurs.id_user', '=', 'users.id_user')
                    ->join('etablissements','administrateurs.Etablissement','=','etablissements.id')
                    ->select('users.id_user','users.email','users.type', 'administrateurs.Nom','administrateurs.prenom','administrateurs.PPR','etablissements.Nom as etab_Nom')
                    ->where('users.id_user',$id)
                    ->orderBy('administrateurs.id')
                    ->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idAdm)
    {
        $adm = Administrateur::find($idAdm);
        $attributs = $request->validate([
            'Nom'=>'required',
            'prenom'=>'required',
            'PPR'=>'required'
        ]);
 //       $attributs['PPR']=Crypt::encrypt($attributs->PPR);
        $adm->update($attributs);
        return response()->json($adm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAdm)
    {
        return Administrateur::find($idAdm)->delete();
    }
}
