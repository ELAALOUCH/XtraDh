<?php

namespace App\Http\Controllers;

use App\Models\enseignant;
use App\Models\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enseignant = enseignant::with(['etab_permanant'])
                                ->with(['grade'])
                                ->with(['intervention'])
                                ->with(['user'])
                                ->with(['paiement'])
                                ->get();
        return response()->json($enseignant);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'PPR'=>'required',
            'Nom'=>'required|max:30',
            'prenom'=>'required|max:30',
            'Date_Naissance'=>'date|required'
        ]);
        $form_fields['Etablissement'] = $request->Etablissement;
        $form_fields['id_Grade'] = $request->id_Grade;
        $form_fields['id_user'] = $request->id_user;
        return enseignant::create($form_fields);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show($idAdm)
    {
        $adm = administrateur::find($idAdm)
            ->with(['user'])
            ->with(['Etablissement'])
            ->get();
        return response()->json($adm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, enseignant $enseignant)
    {
        @dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function destroy(enseignant $enseignant)
    {
        //
    }
}
