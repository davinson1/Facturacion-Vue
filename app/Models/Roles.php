<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  protected $table = 'roles';
  // protected $primaryKey = 'Id_Rol'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['nombre'];
}
