<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etablissement extends Model
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
        return $this->hasMany(enseignant::class,'Etablissement','id');
    }
    public function administrateur()
    {
        return $this->hasMany(administrateur::class,'Etablissement','id');
    }
    public function intervention()
    {
        return $this->hasMany(intervention::class,'id_Etab','id');
    }
    public function paiement()
    {
        return $this->hasMany(paiement::class,'id_Etab','id');
    }

}
