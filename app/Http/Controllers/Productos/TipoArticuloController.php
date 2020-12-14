<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoArticulo;

class TipoArticuloController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver tipo-articulo')->only(['index','create']);    
    $this->middleware('permission:crear tipo-articulo')->only('store');
    $this->middleware('permission:editar tipo-articulo')->only('update');
    $this->middleware('permission:eliminar tipo-articulo')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.tipo_articulo');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return TipoArticulo::all();
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
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u'
      ]);
      TipoArticulo::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, TipoArticulo $tipoArticulo)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u'
      ]);
      $tipoArticulo->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(TipoArticulo $tipoArticulo)
  {
    $tipoArticulo->delete();
  }
}
