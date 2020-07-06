<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos_cerrado extends Model
{
    protected $table = "eventos_cerrados";
    protected $fillable = ['eventos_id', 'datos_id'];

    public function datos_personales(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function eventos(){
        return $this->belongsTo('App\Evento');
    }
}
