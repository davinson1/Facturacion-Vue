<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasRoles;
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
      'telefono',
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
    
    public function getAllPermissionsAttribute() {
      $permissions = [];
        foreach (Permission::all() as $permission) {
          if (Auth::user()->can($permission->name)) {
            $permissions[] = $permission->name;
          }
        }
      return $permissions;
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
