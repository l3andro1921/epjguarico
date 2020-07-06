<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_personal extends Model
{
    protected $table = "datos_personales";
    protected $fillable = ['users_id', 'cedula', 'nombre_completo', 'fecha_nac', 'telefono', 'lugar_nac', 'estudio',
                            'nombre_estudio', 'trabajo', 'nombre_trabajo', 'cargo_trabajo', 'pasatiempo', 'bautizo',
                            'comunion', 'confirmacion', 'parroquia', 'arquidiosesis', 'grupo', 'nombre_grupo', 'tiempo_grupo',
                            'practica_grupo', 'motivo_registro', 'referencia', 'sexo'];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function representantes(){
        return $this->hasOne('App\Representante');
    }

    public function miembros(){
        return $this->hasMany('App\Miembro');
    }

    public function eventos(){
        return $this->hasMany('App\Evento');
    }

    public function eventos_cerrados(){
        return $this->hasMany('App\Eventos_cerrado');
    }

    public function participantes(){
        return $this->hasMany('App\Participante');
    }

    public function pagos(){
        return $this->hasMany('App\Pago');
    }

    public function eventos_agendas(){
        return $this->hasMany('App\Enentos_agenda');
    }

}

