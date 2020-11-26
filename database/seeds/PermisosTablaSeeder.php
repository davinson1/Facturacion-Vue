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

    // crear permisos para modulos
    Permission::create(['name' => 'modulo-inicio', 'categoria' => 'inicio']);
    Permission::create(['name' => 'modulo-usuarios', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'modulo-ubicacion', 'categoria' => 'ubicación']);
    Permission::create(['name' => 'modulo-productos', 'categoria' => 'productos']);
    Permission::create(['name' => 'modulo-compras', 'categoria' => 'compras']);
    Permission::create(['name' => 'modulo-datos-empresa', 'categoria' => 'datos empresa']);
    // crear permisos usuarios    
    Permission::create(['name' => 'ver usuario', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'crear usuario', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'editar usuario', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'eliminar usuario', 'categoria' => 'usuarios']);
    // crear permisos roles
    Permission::create(['name' => 'ver rol', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'crear rol', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'editar rol', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'eliminar rol', 'categoria' => 'usuarios']);
    // crear permisos tipo-documento
    Permission::create(['name' => 'ver tipo-documento', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'crear tipo-documento', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'editar tipo-documento', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'eliminar tipo-documento', 'categoria' => 'usuarios']);
    // crear permisos empresa
    Permission::create(['name' => 'ver empresa', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'crear empresa', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'editar empresa', 'categoria' => 'usuarios']);
    Permission::create(['name' => 'eliminar empresa', 'categoria' => 'usuarios']);
    // crear permisos pais    
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
    // crear permisos proveedor
    Permission::create(['name' => 'ver proveedor', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear proveedor', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar proveedor', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar proveedor', 'categoria' => 'productos']);
    // crear permisos categoria
    Permission::create(['name' => 'ver categoria', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear categoria', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar categoria', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar categoria', 'categoria' => 'productos']);
    // crear permisos producto
    Permission::create(['name' => 'ver producto', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear producto', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar producto', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar producto', 'categoria' => 'productos']);
    // crear permisos tipo-articulo
    Permission::create(['name' => 'ver tipo-articulo', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear tipo-articulo', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar tipo-articulo', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar tipo-articulo', 'categoria' => 'productos']);
    // crear permisos forma-pago
    Permission::create(['name' => 'ver forma-pago', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear forma-pago', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar forma-pago', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar forma-pago', 'categoria' => 'productos']);
    // crear permisos iva
    Permission::create(['name' => 'ver iva', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear iva', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar iva', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar iva', 'categoria' => 'productos']);
    // crear permisos porcentaje
    Permission::create(['name' => 'ver porcentaje', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear porcentaje', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar porcentaje', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar porcentaje', 'categoria' => 'productos']);
    // crear permisos tipo-factura
    Permission::create(['name' => 'ver tipo-factura', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear tipo-factura', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar tipo-factura', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar tipo-factura', 'categoria' => 'productos']);
    // crear permisos tipo-tributario
    Permission::create(['name' => 'ver tipo-tributario', 'categoria' => 'productos']);
    Permission::create(['name' => 'crear tipo-tributario', 'categoria' => 'productos']);
    Permission::create(['name' => 'editar tipo-tributario', 'categoria' => 'productos']);
    Permission::create(['name' => 'eliminar tipo-tributario', 'categoria' => 'productos']);
    // crear permisos tipo-compra
    Permission::create(['name' => 'ver tipo-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'crear tipo-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'editar tipo-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'eliminar tipo-compra', 'categoria' => 'compras']);
    // crear permisos compra
    Permission::create(['name' => 'ver compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'crear compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'editar compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'eliminar compra', 'categoria' => 'compras']);
    // crear permisos consultar-compra
    Permission::create(['name' => 'ver consultar-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'crear consultar-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'editar consultar-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'eliminar consultar-compra', 'categoria' => 'compras']);
    // crear permisos abono-compra
    Permission::create(['name' => 'ver abono-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'crear abono-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'editar abono-compra', 'categoria' => 'compras']);
    Permission::create(['name' => 'eliminar abono-compra', 'categoria' => 'compras']);
    // crear permisos datos-empresa
    Permission::create(['name' => 'ver datos-empresa', 'categoria' => 'datos-empresa']);
    Permission::create(['name' => 'crear datos-empresa', 'categoria' => 'datos-empresa']);
    Permission::create(['name' => 'editar datos-empresa', 'categoria' => 'datos-empresa']);
    Permission::create(['name' => 'eliminar datos-empresa', 'categoria' => 'datos-empresa']);

    // create roles and assign existing permissions
    $role1 = Role::create(['name' => 'supervisor']);
    $role1->givePermissionTo(
      'modulo-inicio',
      'modulo-usuarios',
      'modulo-ubicacion',
      'modulo-productos',
      'modulo-compras',
      'modulo-datos-empresa',
      'ver pais',
      'ver municipio',
      'ver departamento',
      'ver usuario',
      'ver rol',
      'ver tipo-documento',
      'ver empresa',
      'ver proveedor',
      'ver categoria',
      'ver producto',
      'ver tipo-articulo',
      'ver forma-pago',
      'ver iva',
      'ver porcentaje',
      'ver tipo-factura',
      'ver compra',
      'ver consultar-compra',
      'ver abono-compra');

    $role2 = Role::create(['name' => 'admin']);
    $role2->givePermissionTo(
      'modulo-inicio',
      'modulo-usuarios',
      'modulo-ubicacion',
      'modulo-productos',
      'modulo-compras',
      'modulo-datos-empresa',
      'ver pais',
      'ver municipio',
      'ver departamento',
      'ver usuario',
      'ver rol',
      'ver tipo-documento',
      'ver empresa',
      'ver proveedor',
      'ver categoria',
      'ver producto',
      'ver tipo-articulo',
      'ver forma-pago',
      'ver iva',
      'ver porcentaje',
      'ver tipo-factura',
      'ver compra',
      'ver consultar-compra',
      'ver abono-compra',
      'crear pais',
      'crear municipio',
      'crear departamento',
      'crear usuario',
      'crear rol',
      'crear tipo-documento',
      'crear empresa',
      'crear proveedor',
      'crear categoria',
      'crear producto',
      'crear tipo-articulo',
      'crear forma-pago',
      'crear iva',
      'crear porcentaje',
      'crear tipo-factura',
      'crear compra',
      'crear consultar-compra',
      'crear abono-compra',
      'editar pais',
      'editar municipio',
      'editar departamento',
      'editar usuario',
      'editar rol',
      'editar tipo-documento',
      'editar empresa',
      'editar proveedor',
      'editar categoria',
      'editar producto',
      'editar tipo-articulo',
      'editar forma-pago',
      'editar iva',
      'editar porcentaje',
      'editar tipo-factura',
      'editar compra',
      'editar consultar-compra',
      'editar abono-compra');

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
