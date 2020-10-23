<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'municipio';
    // protected $primaryKey = 'Id_Mun'; //por si la llave primaria tiene otro nombre
    protected $fillable = ['id_departamento', 'nombre'];

    public function departamentos()
    {
      // return $this->hasOne('App\Models\Departamentos', 'Id_Depar');
      return $this->belongsTo(Departamentos::class, 'id_departamento');
    }
}
