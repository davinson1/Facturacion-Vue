<?php

use Illuminate\Support\Facades\Route;
use Ubicacion\PaisController;
use Ubicacion\DepartamentoController;
use Ubicacion\MunicipiosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Auth\LoginController@index');
Auth::routes();

Route::middleware(['auth'])->group(function(){
	// Ruta de home
		Route::get('/home', 'HomeController@index')->name('home');
	// Rutas para pais
		Route::resource('paises', PaisController::class)->except(['show', 'edit',])->middleware('permission:ver pais');
	// Rutas para municipios
		Route::resource('municipios', MunicipiosController::class)->except(['show', 'edit',])->middleware('permission:ver municipio');
  // Rutas para departamentos
		Route::resource('departamentos', DepartamentoController::class)->except(['show', 'edit',])->middleware('permission:ver departamento');
});