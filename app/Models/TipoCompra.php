<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCompra extends Model
{
  protected $table = 'tipo_compra';
  // protected $primaryKey = 'Id_Tipo_Compra'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['nombre', 'descripcion', 'created_at', 'updated_at'];
}
