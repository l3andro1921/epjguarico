<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $table = "representantes";
    protected $fillable = ['datos_id', 'nombre_representante', 'telefono'];

    public function datos_personales(){
        return $this->belongsTo('App\Datos_personal');
    }
}
