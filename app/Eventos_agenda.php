<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos_agenda extends Model
{
    protected $table = "eventos_agendas";
    protected $fillable = ['eventos_id', 'datos_id', 'mensaje'];

    public function datos_personales(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function eventos(){
        return $this->belongsTo('App\Evento');
    }

}
