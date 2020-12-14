<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProductos extends Model
{
    protected $table = 'categoria_productos';
    protected $fillable = ['id', 'nombre','descripcion'];
}
