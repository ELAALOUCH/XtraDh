<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interventions = Intervention::with(['etablissement:id,Nom'])
                            ->with(['enseignant:id,PPR,Nom,prenom'])
                            ->get();
  //      $interventions['PPR']=Crypt::decrypt($interventions->PPR);
        return response()->json($interventions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  @dd($request);
        $fields = $request->validate([
           'id_Intervenant'=>'required|exists:enseignants,id',
           'id_Etab'=>'required|exists:etablissements,id',
           'Intitule_Intervention'=>'required',
            'Annee_univ'=>'required',
            'Semestre'=>'required',
            'Date_debut'=>'required',
            'Date_fin'=>'required',
            'Nbr_heures'=>'required'
        ]);
        $intervention = new Intervention($fields);
        return $intervention->save();
    }

    public function storePPR(Request $request){
        
         $fields = $request->validate([
            'PPR'=>'required|exists:enseignants,PPR',
            'id_etab'=>'required|exists:etablissements,id',
            'Intitule_Intervention'=>'required',
             'Annee_univ'=>'required',
             'Semestre'=>'required',
             'Date_debut'=>'required',
             'Date_fin'=>'required',
             'Nbr_heures'=>'required'
         ]);
         $PPR = $request->PPR;
         $intervention = new Intervention();
         $intervention->id_Intervenant = Enseignant::where('PPR',$PPR)->first()->id;
         $intervention->id_Etab = $fields['id_etab'];
         $intervention->Intitule_Intervention = $fields['Intitule_Intervention'];
         $intervention->Annee_univ=$fields['Annee_univ'];
         $intervention->Semestre=$fields['Semestre'];
         $intervention->Date_debut=$fields['Date_debut'];     
         $intervention->Date_fin=$fields['Date_fin'];        
         $intervention->Nbr_heures = $fields["Nbr_heures"];

         return $intervention->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $intervention = Intervention::where('id_intervention',$id);
        return response()->json(
            $intervention->with(['etablissement:id,Nom'])
            ->with(['enseignant:id,PPR,Nom,prenom'])
            ->get()

    );

    }

    public function directeuretabintervall()
    {
        $user = Auth::user();
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $intervention =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','enseignants.Etablissement')
        ->where('etablissements.id',$etb)      
       // ->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures','enseignants.Nom as prof_nom')
        ->select('id_intervention','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb')
        ->orderBy('id_intervention')
        ->get();
        return $intervention; 

    }
    public function directeuretabintervvalid()
    {
        $user = Auth::user();
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        $intervention =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','enseignants.Etablissement')
        ->where('etablissements.id',$etb)      
        ->where('visa_etb',1)
        ->select('id_intervention','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','visa_uae','enseignants.Nom as prof_nom','enseignants.prenom')      
        //->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures','enseignants.Nom as prof_nom')
        ->get();
        return $intervention; 

    }

    

    public function getprofIntervention()
    {
        $user = Auth::user();
      
        
       $intervention =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','enseignants.Etablissement')
        ->where('enseignants.id_user',$user->id_user)    
        ->where('interventions.visa_uae',1)    
        ->where('interventions.visa_uae',1)    
        ->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures')
        ->get();
        return $intervention; 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
        //@dd($request);
        $fields = $request->validate([
            'id_Intervenant'=>'required|exists:enseignants,id',
            'id_Etab'=>'required|exists:etablissements,id',
            'Intitule_Intervention'=>'required',
             'Annee_univ'=>'required',
             'Semestre'=>'required',
             'Date_debut'=>'required',
             'Date_fin'=>'required',
             'Nbr_heures'=>'required'
         ]);
         $intervention->update($fields);
          return response()->json($intervention);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
       $intervention->delete();
       return $intervention;
    }


    public function valideruae($id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
        $intervention->visa_uae = 1 ;
        return $intervention ;
    }
    public function valideretb($id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
        $intervention->visa_etb = 1 ;
        $intervention->update();
        return $intervention ;
    }

    public function invalideruae($id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
        $intervention->visa_uae = 0 ;
        $intervention->update();
        return $intervention ;
    }
    public function invalideretb($id)
    {

       // @dd($id);
        $intervention = Intervention::where('id_intervention',$id)->first();
        $intervention->visa_etb = 0 ;
        $intervention->update();
        return $intervention ;
    }
}
