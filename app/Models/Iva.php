<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
  protected $table = 'iva';
  // protected $primaryKey = 'Id_Iva'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['valor_iva', 'fecha_fin', 'created_at'];
}
