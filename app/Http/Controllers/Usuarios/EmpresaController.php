<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\TipoTributario;
use App\Models\Municipios;

class EmpresaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('usuarios.empresa');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $empresa = Empresa::all();
    $tipoTributario = TipoTributario::all();
    $municipios = Municipios::all();

    return compact('empresa', 'tipoTributario', 'municipios');
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
        'id_tipo_tributario' => 'required|numeric',
        'id_municipio' => 'required|numeric',
        'nombre' => 'required|min:3|max:100|unique:empresa,nombre|regex:/^[\pL\s\-]+$/u',
        'numero' => 'required|numeric',
        'direccion' => 'required|min:3',
        'telefono' => 'required|numeric',
        'celular' => 'required|numeric',
        'nombre_jefe' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        'celular_jefe' => 'required|numeric',
        'fecha_creacion' => 'required|date',
        'descripcion' => 'required',
      ]);
      Empresa::create($data);        
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
