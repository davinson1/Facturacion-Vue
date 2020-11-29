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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, User $perfil)
    {
      $data = request()->validate([
        'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        'apellido' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u',
        'tipo_documento' => 'required|numeric',
        'numero_documento' => 'required|min:6|numeric|unique:users,numero_documento,'.$perfil->id,
        'municipio' => 'required|numeric',
        'direccion' => 'required|string',
        'email' => 'required|email|max:255|unique:users,email,'.$perfil->id,
        'imagen' => 'image|nullable',
        'telefono' => 'required|numeric',
        'contrasenia' => 'nullable|string|min:8|confirmed'
      ]);      
      if (empty($request->contrasenia))
      {
        $pass = $perfil->password;
      }else{
        $pass = Hash::make($data['contrasenia']);
      }
      // Si el usuario cambia la foto
      if($request->hasFile('imagen')){
        // aquí compruebo que exista la foto anterior
        if (\Storage::exists($perfil->foto))
        {
           // aquí la borro
           \Storage::delete($perfil->foto);
        }
        $fotoPerfil=\Storage::putFile('public/fotosusuarios', $request->file('imagen'));      
      }
      $perfil->update([
        'name' => $data['nombre'],
        'apellido' => $data['apellido'],
        'id_tipo_documento' => $data['tipo_documento'],
        'numero_documento' => $data['numero_documento'],
        'id_municipio' => $data['municipio'],
        'direccion' => $data['direccion'],
        'email' => $data['email'],
        'foto' => str_replace("public/","storage/",$fotoPerfil),
        'telefono' => $data['telefono'],
        'password' => $pass
      ]);
    }
  }
