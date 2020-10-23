<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id_tipo_documento',
      'id_municipio',
      'name',
      'apellido',
      'numero_documento',
      'direccion',
      'email',
      'foto',
      'copia_documento',
      'password',
      'activo',
      'remember_token',
    ];

    public function tipoDocumento() {
      return $this->belongsTo(Models\TipoDocumento::class, 'id_tipo_documento');
    }
    public function municipio() {
      return $this->belongsTo(Models\Municipios::class, 'id_municipio');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
