<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   
    protected $primaryKey = 'id_user';

     protected $fillable = [
        
        'email',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function enseignant(){
        return $this->hasOne(Enseignant::class,'id_user','id_user');
    }
    public function administrateur(){
        return $this->hasOne(administrateur::class,'id_user','id_user','users');
    }
    
}
