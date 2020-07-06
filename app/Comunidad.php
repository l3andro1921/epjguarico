<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = "comunidades";
    protected $fillable = ['iglesias_id', 'nombre_comunidad'];

    public function iglesias(){
        return $this->belongsTo('App\Iglesia');
    }

    public function miembros(){
        return $this->hasMany('App\Miembro');
    }
}
