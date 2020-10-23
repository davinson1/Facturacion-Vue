<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosEmpresa extends Model
{
     protected $table = 'datos_empresa_factura';
    // protected $primaryKey = 'Id_Depar'; //por si la llave primaria tiene otro nombre
    protected $fillable = ['nombre','nit','regimen','reso_dian','representacion_legal','direccion','telefono','cuidad','ofrece','nombre_empresa_2','logo'];
 }
