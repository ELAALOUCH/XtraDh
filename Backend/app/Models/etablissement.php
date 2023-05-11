<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etablissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'code',
        'Telephone',
        'Faxe',
        'ville',
        'Nbr_enseignants' 
    ];

    public function enseignant()
    {
        return $this->hasMany('enseignant');
    }
    protected $hidden = ['pivot'];

}
