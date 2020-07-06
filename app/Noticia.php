<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = "noticias";
    protected $fillable = ['titulo', 'lugar', 'fecha', 'resumen', 'descripcion', 'foto'];

    public static function buscar($name){
        return static::where('titulo', 'LIKE', "%$name%");
    }
}
