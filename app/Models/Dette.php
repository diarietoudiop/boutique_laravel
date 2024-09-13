<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Dette extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["montant", "date", "montantVerser", "montantRestant", "client_id"];
    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withPivot("quantite");
    }

}
