<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    protected $fillable = ['eventos_id', 'datos_id', 'tipo_pago', 'banco', 'referencia', 'monto', 'fecha', 'status'];

    public function datos_personales(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function eventos(){
        return $this->belongsTo('App\Evento');
    }
}
