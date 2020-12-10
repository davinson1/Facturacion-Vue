<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\TipoDocumento;
use App\Models\Municipios;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuariosRequest;
use GuzzleHttp\Psr7\Message;
use Spatie\Permission\Models\Role;

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

      $usuarios = User::with('tipoDocumento','roles')->get();
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
    public function store(Request $request)
    {
      request()->validate([
        'idTipoDocumento' => 'required',
        'idMunicipio' => 'required',
        'nombre' => 'required|min:3|max:100',
        'apellido' => 'required|min:3|max:100',
        'documento' => 'required|numeric|min:100000|max:9999999999|unique:users,numero_documento',
        'email' => 'required|unique:users,email',
        'copiaDocumento' => 'nullable|max:3000',
        'rol' => 'required',
        'contrasena' => 'required|min:8|string',
      ]);
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
      $user->foto = 'storage/fotosusuarios/avatar.png';
      $user->copia_documento = str_replace("public/","storage/",$documento);
      $user->password = Hash::make($request->contrasena);
      // $usuario->remember_token = $token;
      $user->activo = '1';
      $user->save();
      $user->assignRole(explode(',',$request->rol));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $usuario)
    {
      request()->validate([
        'idTipoDocumento' => 'required',
        'idMunicipio' => 'required',
        'nombre' => 'required|min:3|max:100',
        'apellido' => 'required|min:3|max:100',
        'documento' => 'required|numeric|min:100000|max:9999999999|unique:users,numero_documento,'.$usuario->id,
        'email' => 'required|unique:users,email,'.$usuario->id,
        'copiaDocumento' => 'nullable|max:3000',
        'rol' => 'required',
        'contrasena' => 'nullable|min:8|string',
      ]);

      if (empty($request->contrasena))
      {
        $pass = $usuario->password;
      }else{
        $pass = Hash::make($request->contrasena);
      }


      if ($request->copiaDocumento==null) {
        $documento = $usuario->copia_documento;
      }else{
           // Si el usuario cambia el documento
      if($request->hasFile('copiaDocumento')){
        // aquí compruebo que exista la foto anterior
        if (\Storage::exists($usuario->copia_documento))
        {
             // aquí la borro
             \Storage::delete($usuario->copia_documento);
        }
        $documento= $usuario->copia_documento=\Storage::putFile('public/documentosusuarios', $request->file('copiaDocumento'));
      }
      }




      $usuario->update([
        'name' => $request->nombre,
        'apellido' => $request->apellido,
        'id_tipo_documento' => $request->idTipoDocumento,
        'numero_documento' =>$request->documento,
        'id_municipio' => $request->idMunicipio,
        'direccion' => $request->direccion,
        'email' => $request->email,
        'copia_documento' => str_replace("public/","storage/",$documento),
        //'telefono' =>$request->telefono,
        'password' => $pass
      ]);
      $usuario->syncRoles(explode(',',$request->rol));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
      $usuario -> delete();

    }
}
