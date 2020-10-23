<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedor';
  // protected $primaryKey = 'Id_proveedor'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['descripcion'];

	public function empresa(){
		return $this->belongsTo(Empresa::class, 'id_empresa');
	}
	 public function usuario() {
    	return $this->belongsTo('App\User', 'id_usuario');
    }


}
