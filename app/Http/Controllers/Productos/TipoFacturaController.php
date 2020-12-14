<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoFactura;

class TipoFacturaController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver tipo-factura')->only(['index','create']);    
    $this->middleware('permission:crear tipo-factura')->only('store');
    $this->middleware('permission:editar tipo-factura')->only('update');
    $this->middleware('permission:eliminar tipo-factura')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.tipo_factura');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return TipoFactura::all();
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
      TipoFactura::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, TipoFactura $tipoFactura)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u'
      ]);
      $tipoFactura->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(TipoFactura $tipoFactura)
  {
    $tipoFactura->delete();
  }
}
