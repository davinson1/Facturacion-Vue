<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TipoCompra;
use App\Models\FormasPago;
use App\Models\CompraTemporal;
use App\Models\Compra;
use App\Models\ArticuloCompra;
use App\Models\HistoricoPreciosProductos;

class CompraController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('compras.compra');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $proveedores = Proveedor::all();
    $tiposCompras = TipoCompra::all();
    $formasPagos = FormasPago::all();
    $compraTemporal = CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();
    $productos = Producto::all();
    return compact('proveedores', 'tiposCompras', 'formasPagos', 'compraTemporal', 'productos');
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
      if ($request->accion == 'producto_temporal') {
        $data = request()->validate(
          [
            'token_usuario' => 'nullable',
            'id_producto' => 'required|numeric',
            'foto' => 'required',
            'codigo_barras' => 'required',
            'descripcion_producto' => 'required',
            'nombre_producto' => 'required|min:3|max:100|unique:compra_temporal,nombre_producto,NULL,id,token_usuario,'.Auth()->user()->remember_token,
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'cantidad_producto' => 'required|numeric',
          ],
          [
            'nombre_producto.unique'=>'El producto "'.$request->nombre_producto.'" ya esta agregado.',
            'precio_compra.required'=>'El campo precio de compra es obligatorio.',
            'precio_venta.required'=>'El campo precio de venta es obligatorio.',
            'cantidad_producto.required'=>'El campo cantidad de compra es obligatorio.'
          ]
        );
        $data['token_usuario'] = Auth()->user()->remember_token;
        compraTemporal::create($data);
        return CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();
      }else{        
        $data = request()->validate([
          'id_usuario'    => 'nullable',
          'id_proveedor'  => 'required|numeric',
          'id_tipo_compra'=> 'required|numeric',
          'id_forma_pago' => 'required|numeric',
          'scanner'       => 'file|nullable',
          'total_compra'  => 'required|numeric',
          'descripcion'   => 'required',
        ]);

        $data['id_usuario'] = Auth()->user()->id;

        if ($request->scanner == null) {
          $data['scanner'] = '';
        }else{
          $data['scanner'] = $request->file('scanner')->store('public/scanner_compra');
        }
        
        $compra = Compra::create($data);
        // Almacenar en la tabla articulo_compra
        if (CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->exists()) {

          $getCompraTemporal = CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();
          foreach ($getCompraTemporal as $compraTemporal) {
            $articuloCompra               = new ArticuloCompra();
            $articuloCompra->id_productos = $compraTemporal->id_producto;
            $articuloCompra->id_compra    = $compra->id;
            $articuloCompra->cantidad     = $compraTemporal->cantidad_producto;
            $articuloCompra->valor_compra = $compraTemporal->precio_compra;
            $articuloCompra->save();

            //guarda las cantides de prodoctos y ponderado de precio venta
            $updateProducto = Producto::find($compraTemporal->id_producto);
            $stock_actual = $updateProducto->cantidad;
            $valor_actual = $updateProducto->valor_venta;
            $stock_nuevo  = $compraTemporal->cantidad_producto;
            $valor_nuevo = $compraTemporal->precio_venta;

            $nuevo_stock = $stock_actual + $stock_nuevo;
            $nuevo_total = ($stock_actual * $valor_actual)+($stock_nuevo * $valor_nuevo);
            $nuevo_precio = $nuevo_total / $nuevo_stock;

            $updateProducto->valor_venta = $nuevo_precio;
            $updateProducto->cantidad = $nuevo_stock;
            $updateProducto->save();

            //Almacenar Historico de precios
            $historicoPrecio = new HistoricoPreciosProductos();
            $historicoPrecio->id_producto = $compraTemporal->id_producto;
            $historicoPrecio->valor_venta = $compraTemporal->precio_venta;
            $historicoPrecio->valor_compra = $request->total_compra;
            $historicoPrecio->save();

          }
          // Eliminar la tabla temporal
          CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->delete();
          return CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();
        }else{
          request()->validate([
            'name' => 'required',
          ], ['name.required' => 'No hay productos agregados.']);
        }
      }      
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($compra)
  {    
    return Producto::where('nombre', 'like', '%'.$compra.'%')->get();    
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
  public function destroy(Request $request, $compra)
  {
    if ($compra == '10-50') {
      CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->delete();
      return CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();
    }else{
      CompraTemporal::where('id', $compra)->delete();      
      return CompraTemporal::where('token_usuario', Auth()->user()->remember_token)->get();      
    }
  }
}
