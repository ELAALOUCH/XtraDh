<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;

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
        $adm = administrateur::with('user')
                              ->with('Etablissement')
                              ->get();

        return $adm;
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
        $adm = administrateur::Create($attributs);
        return response()->json($adm);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function show($idAdm)
    {
        $adm = administrateur::with(['user'])
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
        $adm = administrateur::find($idAdm);
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
        return administrateur::find($idAdm)->delete();
    }
}
