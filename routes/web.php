<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@index');
Auth::routes();

Route::middleware(['auth'])->group(function(){
	// Ruta de home
		Route::get('/home', 'HomeController@index')->name('home');
	// Rutas para Usuarios
		Route::resource('usuarios', 'Usuarios\UsuarioController')->except(['show', 'edit',])->middleware('permission:ver usuario');
		Route::resource('roles', 'Usuarios\RolController')->except(['show', 'edit',])->middleware('permission:ver rol');
		Route::resource('tipoDocumentos', 'Usuarios\TipoDocumentoController')->except(['show', 'edit',])->middleware('permission:ver tipo-documento');
		Route::resource('empresa', 'Usuarios\EmpresaController')->except(['show', 'edit',])->middleware('permission:ver empresa');
	// Rutas para Ubicacion
		Route::resource('paises', 'Ubicacion\PaisController')->except(['show', 'edit',])->middleware('permission:ver pais');
		Route::resource('municipios', 'Ubicacion\MunicipiosController')->except(['show', 'edit',])->middleware('permission:ver municipio');
		Route::resource('departamentos', 'Ubicacion\DepartamentoController')->except(['show', 'edit',])->middleware('permission:ver departamento');
	// Rutas para Productos
		Route::resource('proveedores', 'Productos\ProveedorController')->except(['show', 'edit',])->middleware('permission:ver proveedor');
		Route::resource('categorias', 'Productos\CategoriaController')->except(['show', 'edit',])->middleware('permission:ver categoria');
		Route::resource('productos', 'Productos\ProductoController')->except(['show', 'edit',])->middleware('permission:ver producto');
		Route::resource('tipoArticulos', 'Productos\TipoArticuloController')->except(['show', 'edit',])->middleware('permission:ver tipo-articulo');
		Route::resource('formaPagos', 'Productos\FormaPagoController')->except(['show', 'edit',])->middleware('permission:ver forma-pago');
		Route::resource('ivas', 'Productos\IvaController')->except(['show', 'edit',])->middleware('permission:ver iva');
		Route::resource('porcentajes', 'Productos\PorcentajeController')->except(['show', 'edit',])->middleware('permission:ver porcentaje');
		Route::resource('tipoFacturas', 'Productos\TipoFacturaController')->except(['show', 'edit',])->middleware('permission:ver tipo-factura');
		Route::resource('tipoTributarios', 'Productos\TipoTributarioController')->except(['show', 'edit',])->middleware('permission:ver tipo-tributario');
	// Rutas para Compras
		Route::resource('tipoCompras', 'Compras\TipoCompraController')->except(['show', 'edit',])->middleware('permission:ver tipo-compra');
		Route::resource('compras', 'Compras\CompraController')->except(['show', 'edit',])->middleware('permission:ver compra');
		Route::resource('consultarCompras', 'Compras\ConsultarCompraController')->except(['show', 'edit',])->middleware('permission:ver consultar-compra');
		Route::resource('abonoCompras', 'Compras\AbonoCompraController')->except(['show', 'edit',])->middleware('permission:ver abono-compra');
});
