<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $table = 'pais';
    // protected $primaryKey = 'Id_Pais'; //por si la llave primaria tiene otro nombre
    protected $fillable = ['nombre'];

    // public function departamentos() {
   	// return $this->hasMany('App\Departamentos');
    // }
}
