<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\CompteStatus;




class Client extends Model

{
    use HasFactory, SoftDeletes;

    protected $fillable = ["surname", "adresse", "telephone", "qrcode"];
    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function dettes()
    {
        return $this->hasMany(Dette::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    // public function scopeACompte($query, $compte)
    // {
    //     if ($compte === 'oui') {
    //         return $query->whereNotNull('user_id');
    //     } elseif ($compte === 'non') {
    //         return $query->whereNull('user_id');
    //     }
    //     return $query;
    // }

    public function scopeACompte($query, ?CompteStatus $compte)
    {
        return match($compte) {
            CompteStatus::Oui => $query->whereNotNull('user_id'),
            CompteStatus::Non => $query->whereNull('user_id'),
            default => $query,
        };
    }
}
