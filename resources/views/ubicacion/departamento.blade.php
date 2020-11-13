@extends('layouts.app')
@section('menu-open-ubicacion')
is-expanded
@endsection
@section('active-departamento')
active
@endsection
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fas fa-location-arrow"></i> Departamentos</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
  </ul>
  </div>
  <div id="app" class="row">
    <departamento-component></departamento-component>
  </div>
@endsection
