<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Empresa;

class ProveedorController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver proveedor')->only(['index','create']);    
    $this->middleware('permission:crear proveedor')->only('store');
    $this->middleware('permission:editar proveedor')->only('update');
    $this->middleware('permission:eliminar proveedor')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.proveedor');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $empresa = Empresa::all();
    $proveedor = Proveedor::with('empresa', 'usuario', 'usuario_modifica')->get();
    return compact('empresa', 'proveedor');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = request()->validate([
      'id_empresa' => 'required|numeric',
      'nombre' => 'required|min:3|max:100|unique:proveedor,nombre|regex:/^[\pL\s\-]+$/u',
      'telefono' => 'nullable|min:9|numeric',
      'descripcion' => 'nullable|max:100',
    ]);
    Proveedor::create([
      'id_empresa'=>$data['id_empresa'],
      'id_usuario'=>Auth()->user()->id,
      'nombre'=>$data['nombre'],
      'telefono'=>$data['telefono'],
      'descripcion'=>$data['descripcion'],
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Proveedor $proveedore)
  {

    $data = request()->validate([
      'id_empresa' => 'required|numeric',
      'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:proveedor,nombre,'.$proveedore->id,
      'telefono' => 'nullable|min:9|numeric',
      'descripcion' => 'nullable|max:100',
      'estado' => 'required|boolean',
    ]);
    $proveedore->update([
      'id_empresa'=>$data['id_empresa'],
      'id_usuario_modifica'=>Auth()->user()->id,
      'nombre'=>$data['nombre'],
      'telefono'=>$data['telefono'],
      'descripcion'=>$data['descripcion'],
      'estado'=>(int)$data['estado'],
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Proveedor $proveedore)
  {
    $proveedore->delete();
  }
}
