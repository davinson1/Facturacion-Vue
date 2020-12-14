<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedor';
  // protected $primaryKey = 'Id_proveedor'; //por si la llave primaria tiene otro nombre
  protected $fillable = ['id_empresa', 'id_usuario', 'id_usuario_modifica', 'nombre', 'telefono', 'descripcion', 'estado'];

	public function empresa(){
		return $this->belongsTo(Empresa::class, 'id_empresa');
	}
	public function usuario() {
   	return $this->belongsTo('App\User', 'id_usuario');
  }
  public function usuario_modifica() {
   	return $this->belongsTo('App\User', 'id_usuario_modifica');
  }


}
