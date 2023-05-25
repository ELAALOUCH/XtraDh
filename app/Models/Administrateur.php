<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'PPR',
        'Nom',
        'prenom',
        'Etablissement',
        'id_user',

    ];
    
    public function User(){
       // return $this->belongsTo(user::class,'id','id_user','administrateurs');
       return $this->belongsTo(User::class,'id_user','id_user');
    }
    public function Etablissement(){
        return $this->belongsTo(Etablissement::class,'Etablissement','id');
    }
}
