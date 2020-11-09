<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Paises;


class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('ubicacion.departamento');
    }
    public function listar()
  {
    return Departamentos::with('pais')->get();

  }
  public function selectPais(){
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
        'selected' => 'required',
        'nombre' => 'required|min:3|max:100|unique:departamento,nombre|regex:/^[\pL\s\-]+$/u',
      ]);

      if($request->ajax())
      {
        $pais = new Departamentos();
        $pais->id_pais = $request->selected;
        $pais->nombre = $request->nombre;
        $pais->save();
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

      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:departamento,nombre,'.$request->id,


    ]);
      $departamento = Departamentos::Find($request->id);
      $departamento->id_pais = $request->id_pais;
      $departamento->nombre = $request->nombre;
      $departamento->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $dpto = Departamentos::find($id);
      $dpto->delete();
    }
}
