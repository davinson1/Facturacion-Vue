<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoPreciosProductos extends Model
{
    protected $table = 'historicos_precios_productos';

      protected $fillable = [
	      	'id',
            'id_producto',
            'valor_venta',
	      	'valor_compra',
	      	 ];
}
