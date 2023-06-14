<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_Intervenant',
        'id_Etab',
        'VH',
        'taux_H',
        'Brut',
        'IR',
        'Annee_univ',
        'Semestre',

    ];

    public function enseignant(){
        return $this->belongsTo(Enseignant::class,'id_Intervenant','id');
    }

    public function etablissement(){
        return $this->belongsTo(Etablissement::class,'id_Etab','id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class,'id_Grade','id');
    }
}
