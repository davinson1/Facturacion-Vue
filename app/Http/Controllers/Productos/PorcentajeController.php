<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Porcentaje;

class PorcentajeController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver porcentaje')->only(['index','create']);    
    $this->middleware('permission:crear porcentaje')->only('store');
    $this->middleware('permission:editar porcentaje')->only('update');
    $this->middleware('permission:eliminar porcentaje')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.porcentaje');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return Porcentaje::all();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:porcentaje,nombre|regex:/^[\pL\s\-]+$/u',
        'descripcion' => 'max:100',
        'porcentaje' => 'required'
      ]);
      Porcentaje::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Porcentaje $porcentaje)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:porcentaje,nombre,'.$porcentaje->id,
        'descripcion' => 'max:100',
        'porcentaje' => 'required|numeric'
      ]);
      $porcentaje->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Porcentaje $porcentaje)
  {
    $porcentaje->delete();
  }
}
