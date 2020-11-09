<?php

use App\Http\Controllers\Ubicacion\DepartamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ubicacion\PaisController;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
	Route::get('/pais', [PaisController::class, 'index']);
	Route::get('/listar_paises', [PaisController::class, 'listar']);
	Route::post('/pais_crear', [PaisController::class, 'create']);
	Route::delete('/paises_eliminar/{id}', 'Ubicacion\PaisController@destroy');
	Route::put('/pais_editar', 'Ubicacion\PaisController@update');


  Route::get('/departamento', [DepartamentoController::class, 'index']);
  Route::get('/listar_departamentos', [DepartamentoController::class, 'listar']);
  Route::post('/departamento_crear', [DepartamentoController::class, 'create']);
  Route::get('/select_pais', [DepartamentoController::class, 'selectPais']);
  Route::delete('/departamento_eliminar/{id}', 'Ubicacion\DepartamentoController@destroy');
  Route::put('/departamento_editar', 'Ubicacion\DepartamentoController@update');

});
