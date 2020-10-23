<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermisosTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Permisos para el modulo usuarios
        Permission::create([
          'name' => 'Navegar usuarios',
          'categoria' => 'usuario',
          'slug' => 'navegar.modulo.usuarios',
          'description' => 'El usuario puede ver en el menú el enlace usuarios.',
        ]);
        // permisos para usuario
          Permission::create([
            'name' => 'Navegar usuario',
            'categoria' => 'usuario',
            'slug' => 'navegar.usuario',
            'description' => 'El usuario puede ver en el menú el enlace usuarios.',
          ]);
          Permission::create([
            'name' => 'Crear usuario',
            'categoria' => 'usuario',
            'slug' => 'crear.usuario',
            'description' => 'El usuario puede ver el boton de crear usuarios.',
          ]);
          Permission::create([
            'name' => 'Editar usuario',
            'categoria' => 'usuario',
            'slug' => 'editar.usuario',
            'description' => 'El usuario puede ver el boton de editar usuarios.',
          ]);
          Permission::create([
            'name' => 'Eliminar usuario',
            'categoria' => 'usuario',
            'slug' => 'eliminar.usuario',
            'description' => 'El usuario puede ver el boton de eliminar usuarios.',
          ]);

        // Permisos de roles
          Permission::create([
            'name' => 'Navegar roles',
            'categoria' => 'usuario',
            'slug' => 'navegar.rol',
            'description' => 'Lista y navega todos los roles del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear de roles',
            'categoria' => 'usuario',
            'slug' => 'crear.rol',
            'description' => 'Crear cualquier rol.',
          ]);
          Permission::create([
            'name' => 'Edición de roles',
            'categoria' => 'usuario',
            'slug' => 'editar.rol',
            'description' => 'Editar cualquier rol.',
          ]);
          Permission::create([
            'name' => 'Eliminar rol',
            'categoria' => 'usuario',
            'slug' => 'eliminar.rol',
            'description' => 'Eliminar cualquier rol.',
          ]);

        // Permisos de tipo de documento
          Permission::create([
            'name' => 'Navegar tipo de documento',
            'categoria' => 'usuario',
            'slug' => 'navegar.tipo.documento',
            'description' => 'Lista y navega todos los tipo de documento del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear de tipo de documento',
            'categoria' => 'usuario',
            'slug' => 'crear.tipo.documento',
            'description' => 'Crear cualquier tipo de documento.',
          ]);
          Permission::create([
            'name' => 'Edición de tipo de documento',
            'categoria' => 'usuario',
            'slug' => 'editar.tipo.documento',
            'description' => 'Editar cualquier tipo de documento.',
          ]);
          Permission::create([
            'name' => 'Eliminar tipo de documento',
            'categoria' => 'usuario',
            'slug' => 'eliminar.tipo.documento',
            'description' => 'Eliminar cualquier tipo de documento.',
          ]);

        // Permisos de empresa
          Permission::create([
            'name' => 'Navegar empresas',
            'categoria' => 'usuario',
            'slug' => 'navegar.empresa',
            'description' => 'Lista y navega todas las empresa del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear de empresa',
            'categoria' => 'usuario',
            'slug' => 'crear.empresa',
            'description' => 'Crear  empresa.',
          ]);
          Permission::create([
            'name' => 'Edición de empresa',
            'categoria' => 'usuario',
            'slug' => 'editar.empresa',
            'description' => 'Editar empresa.',
          ]);
          Permission::create([
            'name' => 'Eliminar empresa',
            'categoria' => 'usuario',
            'slug' => 'eliminar.empresa',
            'description' => 'Eliminar empresa.',
          ]);

      // Permisos para el modulo ubicacion
        Permission::create([
          'name' => 'Navegar ubicación',
          'categoria' => 'ubicacion',
          'slug' => 'navegar.modulo.ubicacion',
          'description' => 'El usuario puede ver en el menú el enlace ubicación.',
        ]);
        // Permisos de país
          Permission::create([
            'name' => 'Navegar país',
            'categoria' => 'ubicacion',
            'slug' => 'navegar.pais',
            'description' => 'El usuario puede ver en el menú el enlace país.',
          ]);
          Permission::create([
            'name' => 'Crear país',
            'categoria' => 'ubicacion',
            'slug' => 'crear.pais',
            'description' => 'El usuario puede ver el boton de crear país.',
          ]);
          Permission::create([
            'name' => 'Editar país',
            'categoria' => 'ubicacion',
            'slug' => 'editar.pais',
            'description' => 'El usuario puede ver el boton de editar país.',
          ]);
          Permission::create([
            'name' => 'Eliminar país',
            'categoria' => 'ubicacion',
            'slug' => 'eliminar.pais',
            'description' => 'El usuario puede ver el boton de eliminar país.',
          ]);
        // Permisos de departamento
          Permission::create([
            'name' => 'Navegar departamento',
            'categoria' => 'ubicacion',
            'slug' => 'navegar.departamento',
            'description' => 'El usuario puede ver en el menú el enlace departamento.',
          ]);
          Permission::create([
            'name' => 'Crear departamento',
            'categoria' => 'ubicacion',
            'slug' => 'crear.departamento',
            'description' => 'El usuario puede ver el boton de crear departamento.',
          ]);
          Permission::create([
            'name' => 'Editar departamento',
            'categoria' => 'ubicacion',
            'slug' => 'editar.departamento',
            'description' => 'El usuario puede ver el boton de editar departamento.',
          ]);
          Permission::create([
            'name' => 'Eliminar departamento',
            'categoria' => 'ubicacion',
            'slug' => 'eliminar.departamento',
            'description' => 'El usuario puede ver el boton de eliminar departamento.',
          ]);
        // Permisos de municipio
          Permission::create([
            'name' => 'Navegar municipio',
            'categoria' => 'ubicacion',
            'slug' => 'navegar.municipio',
            'description' => 'El usuario puede ver en el menú el enlace municipio.',
          ]);
          Permission::create([
            'name' => 'Crear municipio',
            'categoria' => 'ubicacion',
            'slug' => 'crear.municipio',
            'description' => 'El usuario puede ver el boton de crear municipio.',
          ]);
          Permission::create([
            'name' => 'Editar municipio',
            'categoria' => 'ubicacion',
            'slug' => 'editar.municipio',
            'description' => 'El usuario puede ver el boton de editar municipio.',
          ]);
          Permission::create([
            'name' => 'Eliminar municipio',
            'categoria' => 'ubicacion',
            'slug' => 'eliminar.municipio',
            'description' => 'El usuario puede ver el boton de eliminar municipio.',
          ]);

      // Permisos para el modulo productos
        Permission::create([
          'name' => 'Navegar modulo productos',
          'categoria' => 'productos',
          'slug' => 'navegar.modulo.productos',
          'description' => 'El usuario puede desplegar el menú productos.',
        ]);
        // Permisos para producto
          Permission::create([
            'name' => 'Navegar productos',
            'categoria' => 'productos',
            'slug' => 'navegar.productos',
            'description' => 'El usuario puede ver en el menú el enlace productos.',
          ]);
          Permission::create([
            'name' => 'Crear productos',
            'categoria' => 'productos',
            'slug' => 'crear.productos',
            'description' => 'El usuario puede ver el boton de crear productos.',
          ]);
          Permission::create([
            'name' => 'Editar productos',
            'categoria' => 'productos',
            'slug' => 'editar.productos',
            'description' => 'El usuario puede ver el boton de editar productos.',
          ]);
          Permission::create([
            'name' => 'Eliminar productos',
            'categoria' => 'productos',
            'slug' => 'eliminar.productos',
            'description' => 'El usuario puede ver el boton de eliminar productos.',
          ]);
        // Permisos de proveedor
          Permission::create([
            'name' => 'Navegar proveedores',
            'categoria' => 'productos',
            'slug' => 'navegar.proveedores',
            'description' => 'El usuario puede ver en el menú el enlace proveedores.',
          ]);
          Permission::create([
            'name' => 'Crear proveedores',
            'categoria' => 'productos',
            'slug' => 'crear.proveedores',
            'description' => 'El usuario puede ver el boton de crear proveedores.',
          ]);
          Permission::create([
            'name' => 'Editar proveedores',
            'categoria' => 'productos',
            'slug' => 'editar.proveedores',
            'description' => 'El usuario puede ver el boton de editar proveedores.',
          ]);
          Permission::create([
            'name' => 'Eliminar proveedores',
            'categoria' => 'productos',
            'slug' => 'eliminar.proveedores',
            'description' => 'El usuario puede ver el boton de eliminar proveedores.',
          ]);          
        // Permisos de formas de pago
          Permission::create([
            'name' => 'Navegar formas de pago',
            'categoria' => 'productos',
            'slug' => 'navegar.formas.pagos',
            'description' => 'El usuario puede ver en el menú el enlace formas de pagos.',
          ]);
          Permission::create([
            'name' => 'Crear formas de pago',
            'categoria' => 'productos',
            'slug' => 'crear.formas.pagos',
            'description' => 'El usuario puede ver el boton de crear formas de pagos.',
          ]);
          Permission::create([
            'name' => 'Editar formas de pago',
            'categoria' => 'productos',
            'slug' => 'editar.formas.pagos',
            'description' => 'El usuario puede ver el boton de editar formas de pagos.',
          ]);
          Permission::create([
            'name' => 'Eliminar formas de pago',
            'categoria' => 'productos',
            'slug' => 'eliminar.formas.pagos',
            'description' => 'El usuario puede ver el boton de eliminar formas de pagos.',
          ]);
        // Permisos de iva
          Permission::create([
            'name' => 'Navegar iva',
            'categoria' => 'productos',
            'slug' => 'navegar.iva',
            'description' => 'El usuario puede ver en el menú el enlace iva.',
          ]);
          Permission::create([
            'name' => 'Crear iva',
            'categoria' => 'productos',
            'slug' => 'crear.iva',
            'description' => 'El usuario puede ver el boton de crear iva.',
          ]);
          Permission::create([
            'name' => 'Editar iva',
            'categoria' => 'productos',
            'slug' => 'editar.iva',
            'description' => 'El usuario puede ver el boton de editar iva.',
          ]);
          Permission::create([
            'name' => 'Eliminar iva',
            'categoria' => 'productos',
            'slug' => 'eliminar.iva',
            'description' => 'El usuario puede ver el boton de eliminar iva.',
          ]);
        // Permisos de porcentaje
          Permission::create([
            'name' => 'Navegar porcentaje',
            'categoria' => 'productos',
            'slug' => 'navegar.porcentaje',
            'description' => 'El usuario puede ver en el menú el enlace porcentaje.',
          ]);
          Permission::create([
            'name' => 'Crear porcentaje',
            'categoria' => 'productos',
            'slug' => 'crear.porcentaje',
            'description' => 'El usuario puede ver el boton de crear porcentaje.',
          ]);
          Permission::create([
            'name' => 'Editar porcentaje',
            'categoria' => 'productos',
            'slug' => 'editar.porcentaje',
            'description' => 'El usuario puede ver el boton de editar porcentaje.',
          ]);
          Permission::create([
            'name' => 'Eliminar porcentaje',
            'categoria' => 'productos',
            'slug' => 'eliminar.porcentaje',
            'description' => 'El usuario puede ver el boton de eliminar porcentaje.',
          ]);
        // Permisos de tipos de facturas
          Permission::create([
            'name' => 'Navegar tipos de facturas',
            'categoria' => 'productos',
            'slug' => 'navegar.tipos.facturas',
            'description' => 'El usuario puede ver en el menú el enlace tipos de facturas.',
          ]);
          Permission::create([
            'name' => 'Crear tipos de facturas',
            'categoria' => 'productos',
            'slug' => 'crear.tipos.facturas',
            'description' => 'El usuario puede ver el boton de creartipos de facturas.',
          ]);
          Permission::create([
            'name' => 'Editar tipos de facturas',
            'categoria' => 'productos',
            'slug' => 'editar.tipos.facturas',
            'description' => 'El usuario puede ver el boton de editar tipos de facturas.',
          ]);
          Permission::create([
            'name' => 'Eliminar tipos de facturas',
            'categoria' => 'productos',
            'slug' => 'eliminar.tipos.facturas',
            'description' => 'El usuario puede ver el boton de eliminar tipos de facturas.',
          ]);
        // Permisos de tipos tributarios
          Permission::create([
            'name' => 'Navegar tipos tributarios',
            'categoria' => 'productos',
            'slug' => 'navegar.tipos.tributario',
            'description' => 'El usuario puede ver en el menú el enlace tipos tributarios.',
          ]);
          Permission::create([
            'name' => 'Crear tipos tributarios',
            'categoria' => 'productos',
            'slug' => 'crear.tipos.tributario',
            'description' => 'El usuario puede ver el boton de creartipos tributarios.',
          ]);
          Permission::create([
            'name' => 'Editar tipos tributarios',
            'categoria' => 'productos',
            'slug' => 'editar.tipos.tributario',
            'description' => 'El usuario puede ver el boton de editar tipos tributarios.',
          ]);
          Permission::create([
            'name' => 'Eliminar tipos tributarios',
            'categoria' => 'productos',
            'slug' => 'eliminar.tipos.tributario',
            'description' => 'El usuario puede ver el boton de eliminar tipos tributarios.',
          ]);

      // Permisos para el modulo compras
        Permission::create([
          'name' => 'Navegar compras',
          'categoria' => 'compras',
          'slug' => 'navegar.modulo.compras',
          'description' => 'El usuario puede ver en el menú el enlace compras.',
        ]);
        // Permiso para compra
          Permission::create([
            'name' => 'Navegar compra',
            'categoria' => 'compras',
            'slug' => 'navegar.compra',
            'description' => 'Lista y navega todos las compras del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear compra',
            'categoria' => 'compras',
            'slug' => 'crear.compra',
            'description' => 'El usuario puede ver el boton de crear compra.',
          ]);
          Permission::create([
            'name' => 'Editar compra',
            'categoria' => 'compras',
            'slug' => 'editar.compra',
            'description' => 'El usuario puede ver el boton de editar compra.',
          ]);
          Permission::create([
            'name' => 'Eliminar compra',
            'categoria' => 'compras',
            'slug' => 'eliminar.compra',
            'description' => 'El usuario puede ver el boton de eliminar compra.',
          ]);

        // Permisos de tipo compra
          Permission::create([
            'name' => 'Navegar tipo de compra',
            'categoria' => 'compras',
            'slug' => 'navegar.tipo.compra',
            'description' => 'Lista y navega todos los tipo de compra del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear tipo de compra',
            'categoria' => 'compras',
            'slug' => 'crear.tipo.compra',
            'description' => 'Crear cualquier tipo de compra.',
          ]);
          Permission::create([
            'name' => 'Editar tipo de compra',
            'categoria' => 'compras',
            'slug' => 'editar.tipo.compra',
            'description' => 'Editar cualquier tipo de compra.',
          ]);
          Permission::create([
            'name' => 'Eliminar tipo de compra',
            'categoria' => 'compras',
            'slug' => 'eliminar.tipo.compra',
            'description' => 'Eliminar cualquier tipo de compra.',
          ]);

        // Permisos de articulo compra
          Permission::create([
            'name' => 'Navegar artículo compra',
            'categoria' => 'compras',
            'slug' => 'navegar.articulo.compra',
            'description' => 'Lista y navega todos los artículo compra del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear de artículo compra',
            'categoria' => 'compras',
            'slug' => 'crear.articulo.compra',
            'description' => 'Crear cualquier artículo compra.',
          ]);
          Permission::create([
            'name' => 'Edición de artículo compra',
            'categoria' => 'compras',
            'slug' => 'editar.articulo.compra',
            'description' => 'Editar cualquier artículo compra.',
          ]);
          Permission::create([
            'name' => 'Eliminar artículo compra',
            'categoria' => 'compras',
            'slug' => 'eliminar.articulo.compra',
            'description' => 'Eliminar cualquier artículo compra.',
          ]);

        // Permisos de abono compra
          Permission::create([
            'name' => 'Navegar abono compra',
            'categoria' => 'compras',
            'slug' => 'navegar.abono.compra',
            'description' => 'Lista y navega todas las abono compra del sistemas.',
          ]);
          Permission::create([
            'name' => 'Crear abono compra',
            'categoria' => 'compras',
            'slug' => 'crear.abono.compra',
            'description' => 'Crear  abono compra.',
          ]);
          Permission::create([
            'name' => 'Edición abono compra',
            'categoria' => 'compras',
            'slug' => 'editar.abono.compra',
            'description' => 'Editar abono compra.',
          ]);
          Permission::create([
            'name' => 'Eliminar abono compra',
            'categoria' => 'compras',
            'slug' => 'eliminar.abono.compra',
            'description' => 'Eliminar abono compra.',
          ]);
    }
}
