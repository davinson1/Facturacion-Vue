<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paises;

class PaisController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {     
    return view('ubicacion.pais');
  }
  public function listar()
  {
    return Paises::all();    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {

    $data = request()->validate([
      'nombre' => 'required|min:3|max:100|unique:pais,nombre|regex:/^[\pL\s\-]+$/u',
    ]);

    if($request->ajax())
    {
      $pais = new Paises();
      $pais->nombre = $request->nombre;
      $pais->save();
      // return response()->json([
      //   "mensaje" => "País editado correctamente."
      //    ]);
      return response()->json(Paises::all());
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
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
  public function update(Request $request)
  {
    $pais = Paises::Find($request->id);
    $pais->nombre = $request->nombre;
    $pais->save();
    return Paises::all();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pais = Paises::find($id);
    $pais->delete();
    return Paises::all();

    }
}
