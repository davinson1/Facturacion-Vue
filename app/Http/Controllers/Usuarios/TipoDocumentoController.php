<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver tipo-documento')->only(['index','create']);    
    $this->middleware('permission:crear tipo-documento')->only('store');
    $this->middleware('permission:editar tipo-documento')->only('update');
    $this->middleware('permission:eliminar tipo-documento')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('usuarios.tipo_documento');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return TipoDocumento::all();

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

  if($request->ajax())
  {
    $data = request()->validate([
      'nombre' => 'required|min:3|max:100|unique:tipo_documento,nombre|regex:/^[\pL\s\-]+$/u',
    ]);
    $tipoDocumento = new TipoDocumento();
    $tipoDocumento->nombre = $request->nombre;
    $tipoDocumento->save();
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
  public function update(Request $request, TipoDocumento $tipoDocumento)
  {
    if($request->ajax())
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|unique:tipo_documento,nombre,'.$tipoDocumento->id,
      ]);

      $tipoDocumento->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(TipoDocumento $tipoDocumento)
  {
    $tipoDocumento->delete();
  }
}
