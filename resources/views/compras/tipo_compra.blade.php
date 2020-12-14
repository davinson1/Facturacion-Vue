@extends('layouts.app')
@section('menu-open-compra')
is-expanded
@endsection
@section('active-tipo-compra')
active
@endsection
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fas fa-store-alt"></i> Tipo compra</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
    </ul>
  </div>
  <div id="app" class="row">
    <tipo-compra-component></tipo-compra-component>
  </div>
@endsection