<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Paises;


class DepartamentoController extends Controller
{
  public function index()
  {
    return view('ubicacion.departamento');
  }

  public function create(Request $request)
  {
    $departamentos = Departamentos::with('pais')->get();
    $paises = Paises::all();
    return compact('departamentos', 'paises');
  }

  public function store(Request $request)
  {
    if($request->ajax())
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:departamento,nombre|regex:/^[\pL\s\-]+$/u',
      ]);
      $departamento = new Departamentos();
      $departamento->id_pais = $request->idPais;
      $departamento->nombre = $request->nombre;
      $departamento->save();
    }
  }

  public function update(Request $request, Departamentos $departamento)
  {
    if($request->ajax())
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:departamento,nombre,'.$departamento->id,
      ]);
      $departamento->id_pais = $request->idPais;
      $departamento->nombre = $request->nombre;
      $departamento->save();
    }
  }

  public function destroy(Request $request, Departamentos $departamento)
  {
    if($request->ajax())
    {
      $departamento->delete();
    }
  }
}
