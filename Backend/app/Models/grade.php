<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'charge_statutaire',
        'Taux_horaire_Vocation'
    ];
    public function enseignant(){
        return $this->hasMany(enseignant::class,'id_Grade','id_Grade','grades');
    }
   

 
}