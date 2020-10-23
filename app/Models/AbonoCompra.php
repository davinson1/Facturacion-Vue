<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbonoCompra extends Model
{
  protected $table = 'abono_compra';
  // protected $primaryKey = 'Id_Abono_Compra'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['id_compra', 'interes', 'numero_cuota', 'total_cuota', 'fecha_programada', 'fecha_compromiso', 'fecha_pago', 'valor', 'valor_pago', 'descripcion_no_pago', 'pagado', 'created_at', 'updated_at '];

  public function compra() {
    return $this->belongsTo(Compra::class, 'id_compra');
  }
  public function porcentaje() {
    return $this->belongsTo(Porcentaje::class, 'interes');
  }
}
