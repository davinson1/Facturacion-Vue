<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = 'productos';
    // protected $primaryKey = 'Id_Articulo'; //por si la llave primaria tiene otro nombre
  protected $fillable = [
    'id_tipo_articulo',
    'id_proveedor',
    'id_articulo',
    'id_porcentaje',
    'id_categoria',
    'nombre',
    'valor_venta',
    'cantidad',
    'porcentaje_minimo',
    'codigo_barras',
    'foto',
    'descripcion',
    'created_at',
    'updated_at'
  ];

  public function tipoArticulos()
  {
    return $this->belongsTo(TipoArticulo::class, 'id_tipo_articulo');
  }

  public function proveedor()
  {
    return $this->belongsTo(Proveedor::class, 'id_proveedor');
  }

  public function categoria()
  {
    return $this->belongsTo(CategoriaProductos::class, 'id_categoria');
  }

  public function porcentaje()
  {
    return $this->belongsTo(porcentaje::class, 'id_porcentaje');
  }
}
