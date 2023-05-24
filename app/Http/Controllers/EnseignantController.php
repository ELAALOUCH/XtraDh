<?php

namespace App\Http\Controllers;

use App\Models\administrateur;
use App\Models\grade;
use App\Models\enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Validator;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enseignant = enseignant::with(['etab_permanant:id,Nom'])
                                ->with(['grade'])
                                ->with(['intervention'])
                                ->with(['user'])
                                ->with(['paiement'])
                                ->get();
        return response()->json($enseignant);


    }


    public function indexETB(){
        //cette methode est pour afficher la liste de prof qui appartient à etablissement de admistrateur (etab_permanent)
        $etb = administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $enseignant = enseignant::where('Etablissement',$etb)->with(['etab_permanant:id,Nom'])->get();
        return  response()->json($enseignant) ;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $form_fields = $request->validate([
    //         'PPR'=>'required',
    //         'Nom'=>'required|max:30',
    //         'prenom'=>'required|max:30',
    //         'Date_Naissance'=>'date|required'
    //     ]);
    //     $form_fields['Etablissement'] = $request->Etablissement;
    //     $form_fields['id_Grade'] = $request->id_Grade;
    //     $form_fields['id_user'] = $request->id_user;
    //     $form_fields['PPR'] = Crypt::encrypt($request->PPR);
    //     return enseignant::create($form_fields);
    // }
    public function store(Request $request)
{
    // Validation des champs
    $validator = Validator::make($request->all(), [
        'PPR' => 'required',
        'Nom' => 'required|max:30',
        'prenom' => 'required|max:30',
        'Date_Naissance' => 'date|required',
        'Etablissement' => 'required',
        'id_Grade' => 'required',
        'id_user' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Cryptage du champ PPR
   // $encryptedPPR = Crypt::encrypt($request->input('PPR'));

    // Création de l'enseignant
    $enseignant = enseignant::create([
        'PPR' => $request->input('PPR'),
        'Nom' => $request->input('Nom'),
        'prenom' => $request->input('prenom'),
        'Date_Naissance' => date('Y-m-d', strtotime( $request->input('Date_Naissance'))),
        'Etablissement' => $request->input('Etablissement'),
        'id_Grade' => $request->input('id_Grade'),
        'id_user' => $request->input('id_user'),
    ]);
    return $enseignant;
    //return response()->json(['message' => 'Enseignant créé avec succès'], 201);
}
public function storeETB(Request $request)
{
    //cette methode pour storer des enseignant dans etablissement de admin (automatiquement)
    // Validation des champs
    $validator = Validator::make($request->all(), [
        'PPR' => 'required',
        'Nom' => 'required|max:30',
        'prenom' => 'required|max:30',
        'Date_Naissance' => 'date|required',
        'Etablissement' => 'required',
        'id_Grade' => 'required',
        'id_user' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Cryptage du champ PPR
   // $encryptedPPR = Crypt::encrypt($request->input('PPR'));

    // Création de l'enseignant
    $enseignant = enseignant::create([
        'PPR' => $request->input('PPR'),
        'Nom' => $request->input('Nom'),
        'prenom' => $request->input('prenom'),
        'Date_Naissance' => date('Y-m-d', strtotime( $request->input('Date_Naissance'))),
        'Etablissement' => $request["Etablissement"],
        'id_Grade' => $request->input('id_Grade'),
        'id_user' => $request["id_user"],
    ]);
    return $enseignant;
    //return response()->json(['message' => 'Enseignant créé avec succès'], 201);
}

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show($idens)
    {
        $ens = enseignant::with(['user'])
            ->with(['grade'])
            ->find($idens);
        return response()->json($ens);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ens = enseignant::find($id);
        $attributs = $request->validate([
            'PPR'=>'required',
            'Nom'=>'required',
            'prenom'=>'required',
            'Date_Naissance' =>'required',
            'Etablissement'=>'required',
            'id_Grade' => 'required',
            'id_user'=>'required'
        ]);
   //     $attributs['PPR']=Crypt::encrypt($attributs->PPR);
        $ens->update($attributs);
        return response()->json($ens);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return enseignant::find($id)->delete();
    }
}
