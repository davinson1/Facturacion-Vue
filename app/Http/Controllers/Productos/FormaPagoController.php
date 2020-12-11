<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormasPago;
class FormaPagoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.forma_pago');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return FormasPago::all();    
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
      'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
    ]);
    FormasPago::create($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, FormasPago $formaPago)
  {
    $data = request()->validate([
      'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
    ]);
    $formaPago->update($data);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(FormasPago $formaPago)
  {
    $formaPago->delete();
  }
}
