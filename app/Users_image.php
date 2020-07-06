<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_image extends Model
{
    protected $table = "users_images";
    protected $fillable = ['users_id', 'nombre_imagen'];

    public function users(){
        return $this->belongsTo('App\User');
    }
}
