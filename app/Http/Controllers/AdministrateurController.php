<?php

namespace App\Http\Controllers;

use App\Models\enseignant;
use Illuminate\Http\Request;
use App\Models\Administrateur;
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


    public function indexETB(){
        //cette methode est pour afficher la liste de prof qui appartient à etablissement de admistrateur (etab_permanent)
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $enseignant = Administrateur::where('Etablissement',$etb)->with(['Etablissement:id,Nom'])
                                                                ->with(['user'])
                                                                ->get();
        return  response()->json($enseignant) ;
    }

    public function directeur($idetab){

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
    public function show($idAdm)
    {
        $adm = Administrateur::with(['user'])
            ->with(['Etablissement'])
            ->find($idAdm);
     //   $adm->PPR=Crypt::decrypt($adm->PPR);
        return response()->json($adm);
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
            'PPR'=>'required',
            'Nom'=>'required',
            'prenom'=>'required',
            'Etablissement'=>'required',
            'id_user'=>'required'
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
