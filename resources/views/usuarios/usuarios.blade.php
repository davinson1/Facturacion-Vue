@extends('layouts.app')
@section('menu-open-usuarios')
is-expanded
@endsection
@section('active-usuario')
active
@endsection
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fas fa-globe-americas"></i> Usuarios del sistema</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
  </ul>
  </div>
  <div id="app" class="row">
    <usuarios-component></usuarios-component>
  </div>
@endsection
