<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paises;

class PaisController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver pais')->only(['index','create']);    
    $this->middleware('permission:crear pais')->only('store');
    $this->middleware('permission:editar pais')->only('update');
    $this->middleware('permission:eliminar pais')->only('destroy');
  }
  public function index()
  {
    return view('ubicacion.pais');
  }

  public function create(Request $request)
  {
    return Paises::all();
  }

  public function store(Request $request)
  {
    if($request->ajax())
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:pais,nombre|regex:/^[\pL\s\-]+$/u',
      ]);
      Paises::create($data);
    }
  }

  public function update(Request $request, Paises $paise)
  {
    if($request->ajax())
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:pais,nombre,'.$paise->id,
      ]);

      $paise->update($data);
    }
  }

  public function destroy(Paises $paise)
  {
    $paise->delete();
  }
}
