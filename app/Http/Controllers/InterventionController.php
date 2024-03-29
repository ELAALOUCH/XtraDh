<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\etablissement;
use App\Models\Administrateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $interventions =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->select('id_intervention','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','visa_uae','enseignants.Nom as prof_Nom','enseignants.prenom','etablissements.Nom as Nom_etb')      
        ->orderBy('id_intervention')
        ->get();
        return response()->json($interventions);
    }
    public function indexvisaetb1()
    {
        $interventions =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->where('interventions.visa_etb',1) 
        ->select('id_intervention','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','visa_uae','enseignants.Nom as prof_Nom','enseignants.prenom','etablissements.Nom as Nom_etb')      
        ->orderBy('id_intervention')
        ->get();
        return response()->json($interventions);
    }
    public function interventionuaevalid()
    {
        $interventions =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->where('interventions.visa_etb',1)    
        ->where('interventions.visa_uae',1)   
        ->select('id_intervention','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','visa_uae','enseignants.Nom as prof_Nom','enseignants.prenom','etablissements.Nom as Nom_etb')      
        ->orderBy('id_intervention')
        ->get();
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

        if(!isset($request->id_etab)){
            $etb = Administrateur::where('id_user',Auth::user()->id_user)->select('Etablissement')->first()->Etablissement; 
        }else{
            $etb = etablissement::find($request->id_etab);
            if($etb==null){
                return response()->json('etablissement not found',404);
            }
            $etb = $etb->id;
        }
         $fields = $request->validate([
            'PPR'=>'required|exists:enseignants,PPR',
            //'id_etab'=>'required|exists:etablissements,id',
            'Intitule_Intervention'=>'required',
             'Annee_univ'=>'required',
             'Semestre'=>'required',
             'Date_debut'=>'required',
             'Date_fin'=>'required',
             'Nbr_heures'=>'required'
         ]);
        $fields['id_etab']= $etb;
        
    
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
            ->first()

    );

    }

    public function directeuretabintervall()
    {
        //$user = Auth::user();
        $etb = Administrateur::where('id_user',Auth::user()->id_user)->first()->Etablissement;
        $intervention =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->where('interventions.id_Etab',$etb)      
       // ->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures','enseignants.Nom as prof_nom')
        ->select('id_intervention','etablissements.Nom as etab','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','enseignants.Nom as prof_nom','enseignants.prenom')
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
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->where('etablissements.id',$etb)      
        ->where('visa_etb',1)
        ->select('id_intervention', 'etablissements.Nom as etab','Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','Nbr_heures','visa_etb','visa_uae','enseignants.Nom as prof_nom','enseignants.prenom')      
        //->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures','enseignants.Nom as prof_nom')
        ->orderBy('id_intervention')
        ->get();
        return $intervention; 

    }

    

    public function getprofIntervention()
    {
        $user = Auth::user();
      
        
       $intervention =  DB::table('interventions')
        ->join('enseignants','interventions.id_Intervenant','=','enseignants.id')
        ->join('etablissements','etablissements.id','=','interventions.id_Etab')
        ->where('enseignants.id_user',$user->id_user)    
        ->where('interventions.visa_etb',1)    
        ->where('interventions.visa_uae',1)    
        ->select('Intitule_Intervention','Annee_univ','Semestre','Date_debut','Date_fin','etablissements.Nom as etab','Nbr_heures')
        ->orderBy('id_intervention')
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
        $intervention->update();
        $intervention = DB::table('interventions')
                            ->join('enseignants','id_Intervenant','=','enseignants.id')
                            ->join('etablissements','interventions.id_Etab','=','etablissements.id')
                            ->join('users','enseignants.id_user','=','users.id_user')
                            ->where('id_intervention',$id)->first();
       

        $email = $intervention->email;
        Mail::send('Mails.valide',['intervention'=>$intervention],function(Message $message)use($email){
            $message->to($email);
            $message->subject('Validation de votre intervention');
        });



        return $intervention ;
    }
    public function valideretb($id)
    {
        $intervention = Intervention::where('id_intervention',$id)->first();
        //return $intervention ; 
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
