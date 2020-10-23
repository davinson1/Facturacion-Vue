<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormasPago extends Model
{
  protected $table = 'forma_pago';
  // protected $primaryKey = 'Id_Forma_Pago'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['nombre'];
}
