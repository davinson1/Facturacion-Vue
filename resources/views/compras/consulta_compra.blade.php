@extends('layouts.app')
@section('menu-open-compra')
is-expanded
@endsection
@section('active-consultar-compra')
active
@endsection
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fas fa-store-alt"></i> Consulta Compras</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
    </ul>
  </div>
  <div id="app" class="row">
    <consulta-compra-component></consulta-compra-component>
  </div>
@endsection
