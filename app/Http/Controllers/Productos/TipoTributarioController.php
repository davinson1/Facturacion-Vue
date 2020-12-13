<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoTributario;

class TipoTributarioController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver tipo-tributario')->only(['index','create']);    
    $this->middleware('permission:crear tipo-tributario')->only('store');
    $this->middleware('permission:editar tipo-tributario')->only('update');
    $this->middleware('permission:eliminar tipo-tributario')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.tipo_tributario');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return TipoTributario::all();
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
      TipoTributario::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, TipoTributario $tipoTributario)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u'
      ]);
      $tipoTributario->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(TipoTributario $tipoTributario)
  {
    $tipoTributario->delete();
  }
}
