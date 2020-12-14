@extends('layouts.app')
@section('menu-open-producto')
is-expanded
@endsection
@section('active-iva')
active
@endsection
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fas fa-file-invoice-dollar"></i> Iva</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
    </ul>
  </div>
  <div id="app" class="row">
    <iva-component></iva-component>
  </div>
@endsection