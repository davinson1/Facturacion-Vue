<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'departamento';
    // protected $primaryKey = 'Id_Depar'; //por si la llave primaria tiene otro nombre
    protected $fillable = ['nombre'];

    public function pais() {
    	return $this->belongsTo(Paises::class, 'id_pais');
    }
}
