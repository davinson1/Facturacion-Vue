<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermisosTablaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Reset cached roles and permissions
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // crear permisos pais
    Permission::create(['name' => 'modulo-ubicacion', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'ver pais', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'crear pais', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'editar pais', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'eliminar pais', 'categoria' => 'ubicación']);
    // crear permisos municipio
    Permission::create(['name' => 'ver municipio', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'crear municipio', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'editar municipio', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'eliminar municipio', 'categoria' => 'ubicación']);
    // crear permisos departamento
    Permission::create(['name' => 'ver departamento', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'crear departamento', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'editar departamento', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'eliminar departamento', 'categoria' => 'ubicación']);

    // create roles and assign existing permissions
    $role1 = Role::create(['name' => 'supervisor']);
    $role1->givePermissionTo(
      'ver pais',
      'ver municipio',
      'ver departamento',
      'crear pais',
      'crear municipio',
      'crear departamento');    

    $role2 = Role::create(['name' => 'admin']);
    $role2->givePermissionTo(
      'modulo-ubicacion',
      'ver pais',
      'ver municipio',
      'ver departamento',
      'crear pais',
      'crear municipio',
      'crear departamento',
      'eliminar pais',
      'eliminar municipio',
      'eliminar departamento');    

    $role3 = Role::create(['name' => 'super-admin']);

    // create demo users
    $user = User::create([

      'id_tipo_documento' => '1',
      'id_municipio' => '1',
      'name' => 'Ensayo',
      'apellido' => 'supervisor',
      'numero_documento' => '123456',
      'direccion' => 'Calle 0 #0-0',
      'telefono' => '3216549874',
      'email' => 'supervisor@gmail.com',
      'foto' => 'ruta/de/la/foto',
      'copia_documento' => 'ruta/de/la/foto/documento',
      'password' => Hash::make('password'),
      'activo' => '1',
    ]);
    $user->assignRole($role1);

    $user = User::create([
      'id_tipo_documento' => '1',
      'id_municipio' => '1',
      'name' => 'Ensayo',
      'apellido' => 'admin',
      'numero_documento' => '12345678',
      'direccion' => 'Calle 0 #0-0',
      'telefono' => '3216549874',
      'email' => 'admin@gmail.com',
      'foto' => 'ruta/de/la/foto',
      'copia_documento' => 'ruta/de/la/foto/documento',
      'password' => Hash::make('password'),
      'activo' => '1',
    ]);
    $user->assignRole($role2);

    $user = User::create([
      'id_tipo_documento' => '1',
      'id_municipio' => '1',
      'name' => 'Ensayo',
      'apellido' => 'super_admin',
      'numero_documento' => '36245678',
      'direccion' => 'Calle 0 #0-0',
      'telefono' => '3216549874',
      'email' => 'super_admin@gmail.com',
      'foto' => 'ruta/de/la/foto',
      'copia_documento' => 'ruta/de/la/foto/documento',
      'password' => Hash::make('password'),
      'activo' => '1',
    ]);
    $user->assignRole($role3);
  }
}
