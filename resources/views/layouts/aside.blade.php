<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="#" alt="User Image">
    <div>
      <p class="app-sidebar__user-name" > {{ Auth::user()->name }} {{ Auth::user()->apellido }}</p>
      <p class="app-sidebar__user-designation">
        @if ($roless = auth()->user()->roles)
          @foreach ($roless as $rol)
            {{$rol->name}}
          @endforeach
        @endif
      </p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="#"><i class="icon fa  fa-user-friends nav-icon"></i> Usuarios</a></li>
        <li><a class="treeview-item" href="#" target="_blank" rel="noopener"><i class="icon fa fa-user-tag"></i> Roles</a></li>
        <li><a class="treeview-item" href="#"><i class="icon fa fa-id-card"></i> Tipo de documento</a></li>
        <li><a class="treeview-item" href="#"><i class="icon fa fa-building"></i> Empresa</a></li>
      </ul>
    </li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Ubicación</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="pais"><i class="icon fa  fa-user-friends nav-icon"></i> País</a></li>
        <li><a class="treeview-item" href="departamento"><i class="icon fa fa-id-card"></i> Departamento</a></li>
        <li><a class="treeview-item" href="municipio"><i class="icon fa fa-building"></i> Municipios</a></li>
      </ul>
    </li>
  </ul>
</aside>
