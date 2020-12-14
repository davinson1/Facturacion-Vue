@extends('layouts.app')
@section('menu-open-producto')
is-expanded
@endsection
@section('active-producto')
active
@endsection
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fas fa-shopping-basket"></i> Productos</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
    </ul>
  </div>
  <div id="app" class="row">
    <producto-component></producto-component>
  </div>
@endsection
