<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    protected $table = "miembros";
    protected $fillable = ['datos_id', 'fecha', 'tipos_id', 'comunidades_id'];

    public function datos(){
        return $this->belongsTo('App\Datos_personal');
    }

    public function tipos(){
        return $this->belongsTo('App\Miembros_tipo');
    }

    public function comunidades(){
        return $this->belongsTo('App\Comunidad');
    }
}
