<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaProductos;

class CategoriaController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver categoria')->only(['index','create']);    
    $this->middleware('permission:crear categoria')->only('store');
    $this->middleware('permission:editar categoria')->only('update');
    $this->middleware('permission:eliminar categoria')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.categoria');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return CategoriaProductos::all();
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
        'descripcion' => 'max:100'
      ]);
      CategoriaProductos::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, CategoriaProductos $categoria)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:porcentaje,nombre|regex:/^[\pL\s\-]+$/u',
        'descripcion' => 'max:100'
      ]);
      $categoria->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(CategoriaProductos $categoria)
  {
    $categoria->delete();
  }
}
