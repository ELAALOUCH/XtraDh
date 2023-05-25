<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nom',
        'code',
        'Telephone',
        'Faxe',
        'ville',
        'Nbr_enseignants' 
    ];
    protected $hidden = ['pivot'];
    public function enseignant()
    {
        return $this->hasMany(Enseignant::class,'Etablissement','id');
    }
    public function administrateur()
    {
        return $this->hasMany(Administrateur::class,'Etablissement','id');
    }
    public function intervention()
    {
        return $this->hasMany(Intervention::class,'id_Etab','id');
    }
    public function paiement()
    {
        return $this->hasMany(Paiement::class,'id_Etab','id');
    }

}
