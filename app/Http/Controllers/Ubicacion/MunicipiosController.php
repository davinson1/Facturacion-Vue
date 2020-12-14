<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipios;
use App\Models\Departamentos;

class MunicipiosController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver municipio')->only(['index','create']);    
    $this->middleware('permission:crear municipio')->only('store');
    $this->middleware('permission:editar municipio')->only('update');
    $this->middleware('permission:eliminar municipio')->only('destroy');
  }
  public function index()
  {
    return view('ubicacion.municipios');
  }

  public function create()
  {
    $municipios = Municipios::with('relacionDepartamentos')->get();
    $departamentos = Departamentos::get();
    return compact('municipios', 'departamentos');
  }

  public function store(Request $request)
  {
    if($request->ajax()){
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:municipio,nombre|regex:/^[\pL\s\-]+$/u',
      ]);
      $municipio = new Municipios();
      $municipio->id_departamento = $request->idDepartamento;
      $municipio->nombre = $request->nombre;
      $municipio->save();
    }
  }
  
  public function update(Request $request, Municipios $municipio)
  {
    if ($request->ajax()){
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:municipio,nombre,'.$municipio->id,
      ]);
      $municipio->update($data);
    }
  }

  public function destroy(Municipios $municipio)
  {
    $municipio->delete();
  }
}
