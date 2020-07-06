<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = "eventos";
    protected $fillable = ['tipos_id', 'status', 'nombre_evento', 'fecha_inicio', 'fecha_final', 'descripcion',
                            'lugar_evento', 'pago', 'monto_pago', 'cupos', 'confirmados', 'id_coordinador',
                            'id_administrador', 'id_asesor'];

    public function datos(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function tipos(){
        return $this->belongsTo('App\Eventos_tipo');
    }

    public function eventos_cerrados(){
        return $this->hasMany('App/Eventos_cerrado');
    }

    public function participantes(){
        return $this->hasMany('App\Participante');
    }

    public function pagos(){
        return $this->hasMany('App\Pago');
    }

    public function eventos_agendas(){
        return $this->hasMany('App\Eventos_agenda');
    }

    public static function buscar($name){
        return static::where('nombre_evento', 'LIKE', "%$name%");
    }
}
