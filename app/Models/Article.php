<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["libelle", "prix", "quantite"];
    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function dettes(){
        return $this->belongsToMany(Dette::class)->withPivot("quantite");
    }


    public function scopeFindByLibelle($query, $libelle)
    {
        return $query->where('libelle', 'like', "%{$libelle}%");
    }

    public function scopeEstDisponible($query, $disponible){
        if($disponible == "oui"){
            return $query->where("quantite", ">", 0);
        }
        elseif($disponible == "non"){
            return $query->where("quantite", 0);
        }
        return $query;
    }

}
