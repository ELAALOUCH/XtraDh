<?php

namespace App\Models;
use App\Models\etablissement;
use App\Models\grade;
use App\Models\paiement;
use App\Models\intervention;
use App\Models\user;
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
        return $this->belongsToMany(etablissement::class,intervention::class,'id_intervenant','id_etab');
        
    }
    public function user(){
        return $this->hasOne('user');
    }

}
