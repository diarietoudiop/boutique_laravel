<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = ["prenom", "nom", "email", "password", "role_id", "estBloquer", "photo"];
    protected $hidden = ["created_at", "updated_at", "deleted_at", "password"];
    protected $casts = ["password"=>"hashed"];


    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function client(){
        return $this->hasOne(Role::class);
    }

    // Constantes pour les rôles
    const ROLE_ADMIN = 'admin';
    const ROLE_CLIENT = 'client';
    const ROLE_BOUTIQUIER = 'boutiquuier';

    // Méthode pour vérifier si l'utilisateur est admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Méthode pour vérifier si l'utilisateur est boutique
    public function isBoutiquier()
    {
        return $this->role === self :: ROLE_BOUTIQUIER;
    }

    // Méthode pour vérifier si l'utilisateur est client
    public function isClient()
    {
        return $this->role === self::ROLE_CLIENT;
    }
}
