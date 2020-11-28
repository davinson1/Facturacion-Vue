@extends('layouts.app')
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fas fa-id-badge"></i> Perfil</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="home">Página Principal</a></li>
  </ul>
  </div>
  <div id="app" class="row">
    <perfil-component></perfil-component>
  </div>
@endsection
