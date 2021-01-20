<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticuloCompra extends Model
{
  protected $table = 'articulo_compra';
  // protected $primaryKey = 'Id_Articulo_Compra'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['id_productos', 'id_compra', 'entregado', 'cantidad', 'descripcion', 'created_at', 'updated_at'];

  public function producto() {
    return $this->belongsTo(Producto::class, 'id_productos');
  }
  public function compra() {
    return $this->belongsTo(Compra::class, 'id_compra');
  }
}
