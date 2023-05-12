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
        $etb = etablissement::with(['paiement'])->get();
        return $etb;
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
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function show( $etablissement)
    {
        return DB::table('etablissement')->where('id',$etablissement)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, etablissement $etablissement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(etablissement $etablissement)
    {
        //
    }
}
