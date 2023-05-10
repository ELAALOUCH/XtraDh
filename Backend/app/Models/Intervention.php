<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

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

    


}
