<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\TipoArticulo;
use App\Models\Proveedor;
use App\Models\Porcentaje;
use App\Models\CategoriaProductos;

class ProductoController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver producto')->only(['index','create']);    
    $this->middleware('permission:crear producto')->only('store');
    $this->middleware('permission:editar producto')->only('update');
    $this->middleware('permission:eliminar producto')->only('destroy');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('productos.producto');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $productos = Producto::with('tipoArticulos', 'proveedor', 'categoria', 'porcentaje')->get();
    $tiposArticulos = TipoArticulo::all();
    $proveedores = Proveedor::all();
    $porcentajes = Porcentaje::all();
    $categorias = CategoriaProductos::all();
    return compact('productos', 'tiposArticulos', 'proveedores', 'porcentajes','categorias');
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
        'foto' => 'image',
        'id_tipo_articulo' => 'required|numeric',
        'id_proveedor' => 'required|numeric',
        'id_categoria' => 'required|numeric',
        'id_porcentaje' => 'required|numeric',
        'nombre' => 'required|min:3|unique:productos,nombre',
        'codigo_barras' => 'required',
        'descripcion' => 'required',
      ]);

      if (empty($data['foto'])) {
        $foto = '';
      }else{
        $data['foto'] = str_replace("public/","storage/",$request->file('foto')->store('public/fotosProductos'));
      }
      Producto::create($data);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Producto $producto)
  {
    if ($request->ajax()) {
      $data = request()->validate([
        'foto' => 'nullable|image',
        'id_tipo_articulo' => 'required|numeric',
        'id_proveedor' => 'required|numeric',
        'id_categoria' => 'required|numeric',
        'id_porcentaje' => 'required|numeric',
        'nombre' => 'required|min:3|unique:productos,nombre,'.$producto->id,
        'codigo_barras' => 'required',
        'descripcion' => 'required',
      ]);
      
      if (empty($data['foto'])) {
        $data['foto'] = $producto->foto;
      }else{
        $data['foto'] = str_replace("public/","storage/",$request->file('foto')->store('public/fotosProductos'));
      }
      $producto->update($data);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Producto $producto)
  {
    $producto->delete();
  }
}
