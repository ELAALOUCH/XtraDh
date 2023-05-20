<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\intervention;
use App\Models\Paiement;
use Illuminate\Http\Request;
use PDF;

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
        $paiement = Paiement::where('id',$id)
                            ->with(['enseignant:id,Nom,prenom'])
                            ->with(['etablissement:id,Nom'])  
                            ->first();
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


    public function postfix(){    
        $postfix = [];   
        $avant = date("Y")-1;
        $apres = date("Y");
        $date = $avant.'/'.$apres ;
        //@dd($date);
        $paiements = Paiement::select('id','id_Intervenant')->where('Annee_univ',$date)->get('id');
        //@dd($paiements = Paiement::select('id','id_Intervenant'));
        foreach($paiements as $paie){
            $enseingant = enseignant::where('id',$paie->id_Intervenant)
                                ->with(['user:id_user,email'])
                                ->first();
            $email = $enseingant->user->email;
            //echo $email."<br>";   
            $url = '/api/generate-pdf/'.$paie->id;
            $nom = $enseingant->Nom;
            $prenom = $enseingant->prenom;  
           $user = ['nom'=>$nom,'prenom'=>$prenom,'email'=>$email,'url'=>$url];
           array_push($postfix,$user); 
        }
return response()->json($postfix);



    }

    public function generatePDFprof($id){
        
        $paiement = Paiement::where('id',$id)
                                ->with(['enseignant:id,Nom,prenom'])
                                ->with(['etablissement:id,Nom'])  
                                ->first();
        //@dd($paiement->enseignant->Nom);
        $intervention = $paiement->enseignant->id ; 
       
        $intervention = intervention::where('id_Intervenant',$intervention)
                                    ->with(['etablissement:id,Nom']) 
                                    ->get()
                                    ;
       // @dd($intervention);
        $data = [
            'paiement'=>$paiement,
            'intervention'=>$intervention
            ];

            $pdf = PDF::loadView('PDF.pdf', $data);
            return $pdf->download('itsolutionstuff.pdf');
    }



}
