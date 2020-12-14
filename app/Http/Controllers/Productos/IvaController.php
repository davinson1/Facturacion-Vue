<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iva;

class IvaController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver iva')->only(['index','create']);    
    $this->middleware('permission:crear iva')->only('store');
    $this->middleware('permission:editar iva')->only('update');
    $this->middleware('permission:eliminar iva')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.iva');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return Iva::all();
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
        'valor_iva' => 'required|numeric',
        'fecha_fin' => 'required|date'
      ]);
      Iva::create($data);      
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Iva $iva)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'valor_iva' => 'required|numeric',
        'fecha_fin' => 'required|date'
      ]);
      $iva->update($data);      
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Iva $iva)
  {
    $iva->delete();
  }
}
