<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements = paiement::with(['enseignant:id,Nom,prenom'])
                              ->with(['etablissement:id,Nom'])  
                              ->get();
        return response()->json($paiements);                      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $fields =  $request->validate([
            'id_Intervenant'=>'required|exists:enseignants,id',
            'id_Etab'=>'required|exists:etablissements,id',
             'VH'=>'required',
             'Taux_H'=>'required', 
             'Annee_univ'=>'required',
             'Semestre'=>'required',
             'Brut'=>'required',
             'IR'=>'required',
          
        ]);
         $paiement = new Paiement();
         $paiement->fill($fields);
         $paiement->Taux_H = $fields["Taux_H"];
         return $paiement->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $paiement = Paiement::find($id)
                            ->with(['enseignant:id,Nom,prenom'])
                            ->with(['etablissement:id,Nom'])  
                            ->get();
        return response()->json($paiement);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $fields =  $request->validate([
            'id_Intervenant'=>'required|exists:enseignants,id',
            'id_Etab'=>'required|exists:etablissements,id',
             'VH'=>'required',
             'Taux_H'=>'required', 
             'Annee_univ'=>'required',
             'Semestre'=>'required',
             'Brut'=>'required',
             'IR'=>'required',
          
        ]);
        $paiement = Paiement::find($id);
        $paiement->Taux_H = $fields["Taux_H"];

        return $paiement->update($fields);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        return $paiement = Paiement::find($id)->delete();
    }
}
