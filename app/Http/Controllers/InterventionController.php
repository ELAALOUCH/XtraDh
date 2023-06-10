<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Intervention;
use Illuminate\Http\Request;
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

    public function getIntervention()
    {
        $user = Auth::user();
        $mois = date('n');
        if($mois > 06){
            $avant = date("Y");
            $apres = date("Y")+1; 
        }
        else{
              $avant = date("Y")-1;
              $apres = date("Y");
        }
      
        $date = $avant.'/'.$apres ;
        DB::table('users')
        ->join('enseignants','users.id_user','=','enseignants.id_user')->get();
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
