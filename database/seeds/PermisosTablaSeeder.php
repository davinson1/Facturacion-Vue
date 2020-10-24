<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
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

        // // create permissions
        // Permission::create(['name' => 'ver']);
        // Permission::create(['name' => 'eliminar']);
        // Permission::create(['name' => 'crear']);
        // Permission::create(['name' => 'editar']);
        // //create roles and assign existing permissions
        // $role1 = Role::create(['name' => 'pruebas']);
        // $role1->givePermissionTo('ver');
        // $role1->givePermissionTo('eliminar');
        // $role3 = Role::create(['name' => 'super-admin']);

        //      // Usuarios
        //      $usuarioadmin = User::create([
        //         'id_tipo_documento' => '1',
        //         'id_municipio' => '1',
        //         'name' => 'William',
        //         'apellido' => 'Guzman',
        //         'numero_documento' => '123456789',
        //         'direccion' => 'Calle 0 #0-0',
        //         'telefono' => '3216549874',
        //         'email' => 'admin@gmail.com',
        //         'foto' => 'ruta/de/la/foto',
        //         'copia_documento' => 'ruta/de/la/foto/documento',
        //         'password' => Hash::make('password'),
        //         'activo' => '1',
        //       ]);
        //       $usuarioadmin->assignRole($role3);


        //       $usuarioensayo = User::create([
                // 'id_tipo_documento' => '1',
                // 'id_municipio' => '1',
                // 'name' => 'Ensayo',
                // 'apellido' => 'Ensayos',
                // 'numero_documento' => '12345678',
                // 'direccion' => 'Calle 0 #0-0',
                // 'telefono' => '3216549874',
                // 'email' => 'ensayo@gmail.com',
                // 'foto' => 'ruta/de/la/foto',
                // 'copia_documento' => 'ruta/de/la/foto/documento',
                // 'password' => Hash::make('password'),
                // 'activo' => '1',
        //       ]);
        //       $usuarioensayo->assingRole($role1);

// Reset cached roles and permissions
app()[PermissionRegistrar::class]->forgetCachedPermissions();

// create permissions
Permission::create(['name' => 'edit articles']);
Permission::create(['name' => 'delete articles']);
Permission::create(['name' => 'publish articles']);
Permission::create(['name' => 'unpublish articles']);

// create roles and assign existing permissions
$role1 = Role::create(['name' => 'writer']);
$role1->givePermissionTo('edit articles');
$role1->givePermissionTo('delete articles');

$role2 = Role::create(['name' => 'admin']);
$role2->givePermissionTo('publish articles');
$role2->givePermissionTo('unpublish articles');

$role3 = Role::create(['name' => 'super-admin']);
// gets all permissions via Gate::before rule; see AuthServiceProvider

// create demo users
$user = User::create([
    'id_tipo_documento' => '1',
                'id_municipio' => '1',
                'name' => 'Ensayo',
                'apellido' => 'Ensayos',
                'numero_documento' => '1234445678',
                'direccion' => 'Calle 0 #0-0',
                'telefono' => '3216549874',
                'email' => 'ensayaaao@gmail.com',
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
                'apellido' => 'Ensayos',
                'numero_documento' => '123465678',
                'direccion' => 'Calle 0 #0-0',
                'telefono' => '3216549874',
                'email' => 'ensayoa@gmail.com',
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
$user->assignRole($role3);


    }
}
