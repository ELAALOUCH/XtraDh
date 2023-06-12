<?php

namespace App\Http\Controllers;

use App\Models\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = grade::all();
        return response()->json($grade);
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
            'designation'=>'required',
            'charge_statutaire'=>'required',
            'Taux_horaire_Vocation'=>'required',
         ]);
         $grade = grade::Create($champs);
         return response()->json($grade); 
         /* $grade= new Grade();
         $grade->designation = $request->designation;
         $grade->charge_statutaire = $request->charge_statutaire;
         $grade->Taux_horaire_Vocation = $request->Taux_horaire_Vocation;
         $grade->save();
         return response()->json($grade); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show($idgrade)
    {
        $grade = grade::find($idgrade);
        return response()->json($grade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idgrade)
    {
         $grade = grade::find($idgrade);
        $champs = $request->validate([
            'designation'=>'required',
            'charge_statutaire'=>'required',
            'Taux_horaire_Vocation'=>'required',
         ]);
         $grade->update($champs);
          return response()->json($grade); 
          /* $grade = grade::find($idgrade);
          $grade->designation = $request->designation;
          $grade->charge_statutaire = $request->charge_statutaire;
          $grade->Taux_horaire_Vocation = $request->Taux_horaire_Vocation;
          $grade->save();
          return response()->json($grade); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($idgrade)
    {
        $grade = grade::find($idgrade);
        $grade->delete();
        return response()->json($grade);
    }
}
