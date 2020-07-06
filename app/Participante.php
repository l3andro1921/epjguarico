<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = "participantes";
    protected $fillable = ['eventos_id', 'datos_id', 'status', 'asistencia'];

    public function datos_personales(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function eventos(){
        return $this->belongsTo('App\Evento');
    }
}
