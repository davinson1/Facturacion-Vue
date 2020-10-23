<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
        protected $table = 'tipo_articulo';
        protected $fillable = ['nombre'];

}
