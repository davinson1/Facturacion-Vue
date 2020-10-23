<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porcentaje extends Model
{
    protected $table = 'porcentaje';

      protected $fillable = [
	      	'id',
	      	 'nombre',
	      	 'descripcion',
	      	 'porcentaje'];
}
