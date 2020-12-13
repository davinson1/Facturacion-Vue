<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoCompra;

class TipoCompraController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver tipo-compra')->only(['index','create']);    
    $this->middleware('permission:crear tipo-compra')->only('store');
    $this->middleware('permission:editar tipo-compra')->only('update');
    $this->middleware('permission:eliminar tipo-compra')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('compras.tipo_compra');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return TipoCompra::all();
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
        'nombre'      => 'required|min:3|unique:tipo_compra,nombre',
        'descripcion' => 'required',
      ]);
      TipoCompra::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, TipoCompra $tipoCompra)
  {
    if ($request->ajax()) {
      $data = request()->validate([        
        'nombre'      => 'required|min:3|unique:tipo_compra,nombre,'.$tipoCompra->id,
        'descripcion' => 'required',
      ]);
      $tipoCompra->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(TipoCompra $tipoCompra)
  {
    $tipoCompra->delete();
  }
}
