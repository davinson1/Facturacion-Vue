<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Caffeinated\Shinobi\Models\Permission;

class UsuarioTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Usuarios
        $usuarioadmin = User::create([
          'id_tipo_documento' => '1',
          'id_municipio' => '1',
          'name' => 'William',
          'apellido' => 'Guzman',
          'numero_documento' => '123456789',
          'direccion' => 'Calle 0 #0-0',
          'telefono' => '3216549874',
          'email' => 'admin@gmail.com',
          'foto' => 'ruta/de/la/foto',
          'copia_documento' => 'ruta/de/la/foto/documento',
          'password' => Hash::make('password'),
          'activo' => '1',
        ]);

        $usuarioensayo = User::create([
          'id_tipo_documento' => '1',
          'id_municipio' => '1',
          'name' => 'Ensayo',
          'apellido' => 'Ensayos',
          'numero_documento' => '12345678',
          'direccion' => 'Calle 0 #0-0',
          'telefono' => '3216549874',
          'email' => 'ensayo@gmail.com',
          'foto' => 'ruta/de/la/foto',
          'copia_documento' => 'ruta/de/la/foto/documento',
          'password' => Hash::make('password'),
          'activo' => '1',
        ]);

      // // roles
      //   $roladmin = Role::create([
      //     'name' => 'Admin',
      //     'slug' => 'admin',
      //     'special' => 'all-access',
      //   ]);

      //   $rolensayo = Role::create([
      //     'name' => 'navegarusuario',
      //     'slug' => 'ensayo',
      //   ]);

      // // Asignar el rol al usuario
      //   $usuarioadmin->roles()->sync([$roladmin->id]);
        
      // // Asignar rol y permiso al usuario de ensayo 
      //   $usuarioensayo->roles()->sync([$rolensayo->id]);

      //   $rolensayo->permissions()->sync(['1', '9']);
    }
}
