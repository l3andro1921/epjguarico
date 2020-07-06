<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iglesia extends Model
{
    protected $table = "iglesias";
    protected $fillable = ['nombre_iglesia'];

    public function comunidades(){
        return $this->hasMany('App\Comunidad');
    }
}
