<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\etablissement;
use Illuminate\Support\Facades\DB;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etab = DB::table('etablissements')
                    ->orderBy('code')
                    ->get();
        return response()->json($etab);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $champs = $request->validate([
            'code'=>'required',
            'Nom'=>'required',
            'Telephone'=>'required',
            'Faxe'=>'required',
            'ville'=>'required',
            'Nbr_enseignants'=>'required',
         ]);
         $etab = new Etablissement();
         $etab->code = $champs['code'];
         $etab->Nom = $champs['Nom'];
         $etab->Telephone = $champs['Telephone'];
         $etab->Faxe = $champs['Faxe'];
         $etab->ville = $champs['ville'];
         $etab->Nbr_enseignants = $champs['Nbr_enseignants'];
         
         return response()->json($etab->save());
         
         /* $etab = new Etablissement();
         $etab->code = $request->code;
         $etab->Nom = $request->Nom;
         $etab->Telephone = $request->Telephone;
         $etab->Faxe = $request->Faxe;
         $etab->ville = $request->ville;
         $etab->Nbr_enseignants = $request->Nbr_enseignants;
         $etab->save();
         return response()->json($etab); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function show($idetab)
    {
        $etab = Etablissement::find($idetab);
        return response()->json($etab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idetab)
    {
         $etab = Etablissement::find($idetab);
        $champs = $request->validate([
            'code'=>'required',
            'Nom'=>'required',
            'Telephone'=>'required',
            'Faxe'=>'required',
            'ville'=>'required',
            'Nbr_enseignants'=>'required',
         ]);
         $etab->update($champs);
          return response()->json($etab); 
          /* $etab = Etablissement::find($idetab);
          $etab->code = $request->code;
          $etab->Nom = $request->Nom;
          $etab->Telephone = $request->Telephone;
          $etab->Faxe = $request->Faxe;
          $etab->ville = $request->ville;
          $etab->Nbr_enseignants = $request->Nbr_enseignants;
          $etab->save();
          return response()->json($etab); */

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy($idetab)
{
    $etab = Etablissement::find($idetab);
    $etab->delete();
    return response()->json($etab);
}
}
