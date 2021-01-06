<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detalle Compra</title>
  <link href="./css/apppdf.css" rel="stylesheet" type="text/css"   media="screen"/>
  <style>
    body{
      background-color:#fff;
    }
    .titulo{
      text-align: center;
    }
    .titulo-empresa{
      font-weight: bold;
      font-size: 20px,
    }
    .titulo-proveedor {
      font-weight: bold;
      padding-left: 10px;

    }
  </style>
</head>
<body >


<h5 class="titulo bg-primary text-light">ORDEN DE COMPRA</h5>


<div class="float-left " style="padding: 5px; text-align:center;">
  @foreach ($empresaFactura as $item)
    <div class="titulo-empresa">{{$item->nombre}}</div>
    <div>Nit: {{$item->nit}}</div>
    <div>Dirección: {{$item->direccion}}</div>
    <div>Teléfonos: {{$item->telefono}}</div>
    <div>Ubicación: {{$item->ciudad}}</div>
    @endforeach
</div>

<div class="float-right border" style="padding: 5px;">
  @foreach ($comprac as $item)
    <div>Fecha: {{$item->created_at}}</div>
    <div>Número de Orden: <strong >{{$item->id}} </strong></div>
    @endforeach
</div>

<br>
<br>
<br>
<br>
<br>
<br>

<div style="border: 1px solid #c0c0c0">
<div class="titulo-proveedor bg-primary text-light" > Datos Proveedor:</div>

<table class="table table-sm" style="font-size: 12px">
  <tbody>
    <tr>
      @foreach ($comprac as $item)
          <td>Nombre Vendedor: {{$item->proveedor->nombre}}</td>
          <td>Telefono: {{$item->proveedor->telefono}}</td>
          <td>Descripción: {{$item->proveedor->descripcion}}</td>
      @endforeach
    </tr>
    <tr>
      @foreach ($proveedor as $item)
      <td>Nombre Empresa: {{$item->empresa->nombre}}</td>
      <td>Nombre Nit: {{$item->empresa->numero}}</td>
      <td>Nombre Dirección: {{$item->empresa->direccion}}</td>
      <td>Nombre Teléfono: {{$item->empresa->telefono}} {{$item->empresa->celular}}</td>
      @endforeach
    </tr>


  </tbody>
</table>
</div>

<br>

<table class="table table-sm ">
  <thead class="bg-primary text-light">
    <tr>
      <th scope="col">Cantidad</th>
      <th scope="col">Nombre</th>
      <th scope="col">Valor Unitario</th>
      <th scope="col">Valor Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($compras as $item)
    <tr>
      <th scope="row">{{$item->cantidad}}</th>
      <td>{{$item->producto->nombre}}</td>
      <td>{{$item->valor_compra}}</td>
      <td>{{$item->compra->total_compra}}</td>
    </tr>
    @endforeach
  </tbody>

  <tfoot class="font-weight-bold">
    <tr>
      <td></td>
      <td></td>
      <td colspan="0" >Total $</td>
      <td>{{$item->compra->total_compra}}</td>
    </tr>
  </tfoot>

</table>



</body>
</html>
