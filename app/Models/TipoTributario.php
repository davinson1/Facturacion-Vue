<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTributario extends Model
{
  protected $table = 'tipo_tributario';
  // protected $primaryKey = 'Id_Tipo_Tributario'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['nombre'];
}
