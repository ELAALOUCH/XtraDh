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
        return $this->belongsTo('etablissement');
    }
    public function grade()
    {
        return $this->belongsTo('grade');
    }
    public function  paiement(){
        return $this->hasMany('paiement');
        
    }
    public function  intervention(){
        return $this->hasMany('intervention');
        
    }
    public function user(){
        return $this->hasOne('user');
    }

}
