<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ubicacion\PaisController;
use App\Http\Controllers\Ubicacion\MunicipioController;

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
	// Rutas para pais
		Route::get('/pais', [PaisController::class, 'index']);
		Route::get('/listar_paises', [PaisController::class, 'listar']);
		Route::post('/pais_crear', [PaisController::class, 'create']);
		Route::delete('/paises_eliminar/{id}', 'Ubicacion\PaisController@destroy');
		Route::put('/pais_editar', 'Ubicacion\PaisController@update');
	// Rutas para municipios
    Route::get('/municipios', 'Ubicacion\MunicipiosController@index')->name('municipios');
    Route::get('/listar_municipios', 'Ubicacion\MunicipiosController@listarMunicipios');
    Route::post('/municipios_crear', 'Ubicacion\MunicipiosController@store')->name('municipios_crear');
    Route::post('/municipios_editar', 'Ubicacion\MunicipiosController@update')->name('municipios_editar');
    Route::post('/municipios_eliminar', 'Ubicacion\MunicipiosController@destroy')->name('municipios_eliminar');
});
