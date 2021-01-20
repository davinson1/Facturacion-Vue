<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\ArticuloCompra;
use App\Models\Empresa;
use App\Models\DatosEmpresa;
use App\Models\Producto;
use App\Models\Proveedor;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class ConsultarCompraController extends Controller
{
  public function __construct()
  {
    $this->middleware('permission:ver consulta-compra')->only(['index','create']);
    $this->middleware('permission:crear consulta-compra')->only('store');
    $this->middleware('permission:editar consulta-compra')->only('update');
    $this->middleware('permission:eliminar consulta-compra')->only('destroy');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('compras.consulta_compra');
    }

    public function buscarCompras(Request $request){

      $date1 = date_create($request->fecha1);
      $date2 = date_create($request->fecha2);
      $converf1 = date_format($date1,'Y-m-d H:i:s');
      $converf2 = date_format($date2,'Y-m-d H:i:s');
      return Compra::with('tipoCompra','usuario','formadepago','proveedor')->whereBetween('created_at',[$converf1,$converf2])->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return Compra::with('tipoCompra','usuario','formadepago','proveedor')->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $empresaFactura = DatosEmpresa::all();
      $compras = ArticuloCompra::with('producto','compra')->where('id_compra', $id)->get();
      $comprac = Compra::with('usuario','proveedor')->where('id', $id)->get();
      foreach($comprac as $re){
        $proveedor = Proveedor::with('empresa')->where('id', $re->id_proveedor)->get();
      }
      $pdf = $v= PDF::loadView('compras.detalle_compraspdf', compact('compras','empresaFactura','comprac','proveedor'));
      return $pdf->stream();

      //return view('compras.detalle_compraspdf',compact('compra'));

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
      $estadoCompra = Compra::all()->where('id',$id);
      foreach($estadoCompra as $estado) {
          if($estado->estato == 1){
          DB::table('compra')->where('id', $id)->update(['estato' => 0]);
          $ariculoCompra = ArticuloCompra::with('compra','producto')->where('id_compra',$id)->get();

          foreach ($ariculoCompra as $item){
            $updateProducto = Producto::find($item->id_productos);
             $stockActual = $updateProducto->cantidad;
             $valorActual = $updateProducto->valor_venta;
             $stockNuevo = $item->cantidad;
             $valorNuevo = $item->valor_compra;

            $nuevoStock = $stockActual - $stockNuevo;
            $nuevoTotal = ($stockActual * $valorActual)-($stockNuevo * $valorNuevo);
            $nuevo_precio = $nuevoTotal / $nuevoStock;

            $updateProducto->valor_venta = $nuevo_precio;
            $updateProducto->cantidad = $nuevoStock;
            $updateProducto->save();

          }
          return response()->json([
            true
          ]);
        }else {
          return response()->json([
            false
          ]);
        }
      }


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
