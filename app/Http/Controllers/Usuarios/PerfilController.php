<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\TipoDocumento;
use App\Models\Municipios;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('usuarios.perfil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $usuario = User::with('tipoDocumento','municipio','roles')->where('id',Auth::user()->id)->get();      
      $roles = Auth::user()->roles;
      $documentos = TipoDocumento::all();
      $municipios = Municipios::all();
      return compact('usuario', 'roles', 'documentos','municipios');
    }
    public function store(Request $request)
    {
      return $request->imagen;
      $foto = $request->file('imagen')->store('public/fotosusuarios');
      exit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, User $perfil)
    {
      dd($request->imagen);
      var_dump($request->imagen);
      return $request->imagen;
      exit();
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        'apellido' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        'tipo_documento' => 'required|numeric',
        'numero_documento' => 'required|min:6|numeric|unique:users,numero_documento,'.$perfil->id,
        'municipio' => 'required|numeric',
        'direccion' => 'required|string',
        'email' => 'required|email|max:255|unique:users,email,'.$perfil->id,
        'telefono' => 'required|numeric',
      ]);   
      if (empty($request->contrasenia))
      {        
        $pass = $perfil->password;
      }else{
        $clave = request()->validate([
          'contrasenia' => 'required|string|min:8|confirmed'
        ]);
        $pass = Hash::make($clave['contrasenia']);
      }
      $perfil->update([
        'name' => $data['nombre'],
        'apellido' => $data['apellido'],
        'id_tipo_documento' => $data['tipo_documento'],
        'numero_documento' => $data['numero_documento'],
        'id_municipio' => $data['municipio'],
        'direccion' => $data['direccion'],
        'email' => $data['email'],
        'telefono' => $data['telefono'],
        'password' => $pass,
      ]);
    }
  }
