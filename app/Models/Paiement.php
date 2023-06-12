<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiement extends Model
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
        return $this->belongsTo(enseignant::class,'id_Intervenant','id');
    }

    public function etablissement(){
        return $this->belongsTo(etablissement::class,'id_Etab','id');
    }
    public function grade(){
        return $this->belongsTo(grade::class,'id_Grade','id');
    }
}
