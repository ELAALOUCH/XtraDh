<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\grade;
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
        $paiements = Paiement::with(['enseignant:id,Nom,prenom'])
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
        //cette methode pour envoye la liste des paiement au developpeur POSTFIX LINUX
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

    public function generatePDFprof($id_paiement){
        //cette methode pour la generation des pdf des paiement
        
        $paiement = Paiement::where('id',$id_paiement)
            ->with(['enseignant:id,Nom,prenom,id_Grade'])
            ->with(['etablissement:id,Nom'])
            ->first();

        $grade = Grade::where('id_Grade',$paiement->enseignant->id_Grade)->first();
        //@dd($paiement->enseignant->Nom);
        $intervention = $paiement->enseignant->id ;

        $intervention = intervention::where('id_Intervenant',$intervention)
                                    ->where('visa_uae',1)
                                    ->where('visa_etb',1)
                                    ->with(['etablissement:id,Nom']) 
                                    ->get()
                                    ;
       // @dd($intervention);
       //return $intervention ;  
       $data = [
            'paiement'=>$paiement,
            'intervention'=>$intervention,
            'grade'=>$grade
            ];
            
            $pdf = PDF::loadView('PDF.pdf', $data);
           return  $pdf->download('itsolutionstuff.pdf');
    }

    public function paiementprof($id_prof)
    {
        $paiement = Paiement::where('id_Intervenant',$id_prof)
        ->with(['enseignant:id,Nom,prenom,id_Grade'])
        ->with(['etablissement:id,Nom'])
        ->first();
        $grade = Grade::where('id_Grade',$paiement->enseignant->id_Grade)->first();
        return $grade;
    }
    
}
