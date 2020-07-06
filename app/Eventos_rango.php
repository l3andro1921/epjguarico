<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos_rango extends Model
{
    protected $table = "eventos_rangos";
    protected $fillable = ['tipos_id', 'miembros_tipos_id'];

    public function miembros(){
        return $this->belongsTo('App\Miembros_tipo');
    }

    public function tipo(){
        return $this->belongsTo('App\Eventos_tipo');
    }

}
