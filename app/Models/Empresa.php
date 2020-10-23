<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table = 'empresa';
  // protected $primaryKey = 'Id_Empresa'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['id_tipo_tributario', 'id_municipio', 'nombre', 'numero', 'direccion', 'telefono', 'celular', 'descripcion', 'nombre_jefe', 'celular_jefe', 'estado', 'fecha_creacion'];
}
