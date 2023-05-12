<?php

namespace App\Models;
use App\Models\etablissement;
use App\Models\grade;
use App\Models\paiement;
use App\Models\intervention;
use App\Models\user;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
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
        return $this->belongsTo(etablissement::class,'id','id','enseignant');
    }
    public function grade()
    {
        return $this->belongsTo(grade::class,'id','id_Grade','enseignant');
    }
    public function  paiement(){
        return $this->hasMany(paiement::class,'id_Intervenant','id','enseignant');
        
    }
    public function  intervention(){
        return $this->belongsToMany(etablissement::class,intervention::class,'id_Intervenant','id_Etab');
        
    }
    public function user(){
        return $this->belongsTo(user::class,'id','id_user','enseignants');
    }


}
