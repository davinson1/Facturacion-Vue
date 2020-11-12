<?php

namespace App\Http\Controllers\Ubicacion;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Municipios;
use App\Models\Departamentos;

class MunicipiosController extends Controller
{
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
      $municipio = new Municipios();
      $municipio->id_departamento = $request->idDepartamento;
      $municipio->nombre = $request->nombre;
      $municipio->save();
    }
  }
  
  public function update(Request $request, Municipios $municipio)
  {
    if ($request->ajax()){
      $municipio->id_departamento = $request->idDepartamento;
      $municipio->nombre = $request->nombre;
      $municipio->save();
    }
  }

  public function destroy(Municipios $municipio)
  {    
    $municipio->delete();
  }
}
