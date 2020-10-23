<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraTemporal extends Model
{
    protected $table = 'compra_temporal';
    // protected $primaryKey = 'Id_Depar'; //por si la llave primaria tiene otro nombre
    protected $fillable = ['token_usuario','nombre_producto','foto', 'cantidad_producto', 'precio_compra', 'precio_venta', 'id_producto','codigo_barras','descripcion_producto'];

}
