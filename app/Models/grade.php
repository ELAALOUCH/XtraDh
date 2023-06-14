<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_Grade';

    protected $fillable = [
        'designation',
        'charge_statutaire',
        'Taux_horaire_Vocation'
    ];
    public function enseignant(){
        return $this->hasMany(Enseignant::class,'id_Grade','id_Grade','grades');
    }
   

 
}