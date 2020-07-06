<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos_tipo extends Model
{
    protected $table = "eventos_tipos";
    protected $fillable = ['tipo_evento'];

    public function rangos(){
        return $this->hasMany('App\Eventos_rango');
    }

    public function eventos(){
        return $this->hasMany('App\Evento');
    }
}
