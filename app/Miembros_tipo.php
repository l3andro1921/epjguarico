<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembros_tipo extends Model
{
    protected $table = "miembros_tipos";
    protected $fillable = ['tipo_miembro'];

    public function miembros(){
        return $this->hasMany('App\Miembro');
    }

    public function rangos(){
        return $this->hasMany('App\Eventos_rango');
    }
}
