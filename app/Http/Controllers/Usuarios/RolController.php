<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('usuarios.rol');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::all();
      $permisos = Permission::get();
      $categorias = Permission::select('categoria')->groupBy('categoria')->get();      
      return compact('roles', 'permisos', 'categorias');
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
          'nombre' => 'required|min:3|max:100|unique:roles,name|regex:/^[\pL\s\-]+$/u',
        ]);
        $role = Role::create(['name' => $request->nombre]);
        $role->syncPermissions($request->permisos);
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
    public function edit(Role $role)
    {      
      return $role->getAllPermissions();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
      if($request->ajax())
      {
        $data = request()->validate([
          'nombre' => 'required|min:3|max:100|regex:/^[\pL\s\-]+$/u|unique:roles,name,'.$role->id,
        ]);
        $role->update(['name' => $data['nombre']]);
        $role->syncPermissions($request->permisos);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
      $role->delete();
    }
  }
