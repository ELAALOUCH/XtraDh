<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'PPR',
        'Nom',
        'prenom',
        'Etablissement',
    ];
    
    public function user(){
       // return $this->belongsTo(user::class,'id','id_user','administrateurs');
       return $this->belongsTo(user::class,'id_user','id_user');
    }
    public function etablissement(){
        return $this->belongsTo(etablissement::class,'Etablissement','id');
    }
}
