<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFactura extends Model
{
  protected $table = 'tipo_factura';
  // protected $primaryKey = 'Id_Tipo_Factura'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['nombre'];
}
