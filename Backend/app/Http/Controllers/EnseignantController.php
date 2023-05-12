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
        //$ens_intv = enseignant::all();
        //$ens = enseignant::find(1);
       // $grade = 
       // $grades = DB::table('grades')->where('id_Grade',1)->first();
       // return $grade->enseignant;
      // $grade = grade::with(['enseignant'])->get();
       // $paie = enseignant::find(1)->paiement;
      // return $paie;
       $enseignant = enseignant::where('id',1)->first();
      $enseignant=enseignant::with(['grade'])
                                ->with(['etab_permanant'])
                                ->with(['paiement'])
                                ->with(['user'])
                                ->select('id','Nom')
                                ->get();
          //$enseignant = enseignant::with(['etab_permanant'])->get();                      
        return $enseignant  ;                      



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show(enseignant $enseignant)
    {
        //
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
        //
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
