<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_intervention';

    protected $fillable = [
        
        'id_Intervenant',
        'id_Etab',
        'Intitule_Intervention',
        'Annee_univ',
        'Semestre',
        'Date_debut',
        'Date_fin',
        'Nbr_heures'
    ];

    public function enseignant(){
        return $this->belongsTo(Enseignant::class,'id_Intervenant','id');
    }
    public function etablissement(){
        return $this->belongsTo(Etablissement::class,'id_Etab','id');
    }


}
