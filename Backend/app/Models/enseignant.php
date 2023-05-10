<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enseignant extends Model
{
    use HasFactory;
    protected $fillable = [
        'PPR',
        'Nom',
        'prenom',
        'Date_Naissance',
        'Etablissement',
        'id_Grade'
    ];

    public function etab_permanant(){
        return $this->hasOne('etablissement');
    }
    public function grade()
    {
        return $this->hasOne('grade');
    }
    public function  paiement(){
        return $this->hasMany('paiement');
        
    }

}
