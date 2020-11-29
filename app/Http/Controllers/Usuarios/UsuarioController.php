<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\TipoDocumento;
use App\Models\Municipios;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuariosRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;







class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.usuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $usuarios = User::with('tipoDocumento')->get();
      $tiposDocumentos = TipoDocumento::all();
      $municipios = Municipios::all();
      $roles = Role::all();
      return compact('usuarios', 'tiposDocumentos','municipios','roles');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest $request)
    {

      if ($request->foto==null) {
        $foto = '';
      }else{
        $foto = $request->file('foto')->store('public/fotosusuarios');
      }

      if ($request->copiaDocumento==null) {
        $documento = '';
      }else{
        $documento = $request->file('copiaDocumento')->store('public/documentosusuarios');
      }

      $user = new User();
      $user->id_tipo_documento = $request->idTipoDocumento;
      $user->id_municipio = $request->idMunicipio;
      $user->name = $request->nombre;
      $user->apellido = $request->apellido;
      $user->numero_documento = $request->documento;
      $user->direccion = $request->direccion;
      $user->email = $request->email;
      $user->foto = $foto;
      $user->copia_documento = $documento;
      $user->password = Hash::make($request->contrasena);
      // $usuario->remember_token = $token;
      $user->activo = '1';
      $user->save();
      $user->assignRole(explode(',',$request->rol));

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
