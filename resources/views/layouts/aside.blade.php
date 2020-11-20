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
    <li class="treeview @yield('menu-open-usuarios')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item @yield('active-usuario')" href="#"><i class="icon fa  fa-user-friends"></i> Usuarios</a></li>
        <li><a class="treeview-item @yield('active-rol')" href="#" target="_blank" rel="noopener"><i class="icon fa fa-user-tag"></i> Roles</a></li>
        <li><a class="treeview-item @yield('active-tipo-documento')" href="#"><i class="icon fa fa-id-card"></i> Tipo de documento</a></li>
        <li><a class="treeview-item @yield('active-empresa')" href="#"><i class="icon fa fa-building"></i> Empresa</a></li>
      </ul>
    </li>
    @can('modulo-ubicacion')
      <li class="treeview @yield('menu-open-ubicacion')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-map-marked-alt"></i><span class="app-menu__label">Ubicación</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @can('ver pais')
            <li>
              <a class="treeview-item @yield('active-pais')" href="paises"><i class="icon fas fa-globe-americas"></i> País</a>
            </li>
          @endcan
          @can('ver departamento')
            <li>
              <a class="treeview-item @yield('active-departamento')" href="departamentos"><i class="icon fas fa-location-arrow"></i> Departamento</a>
            </li>
          @endcan
          @can('ver municipio')
            <li>
              <a class="treeview-item @yield('active-municipio')" href="municipios"><i class="icon fas fa-thumbtack"></i> Municipios</a>
            </li>
          @endcan
        </ul>
      </li>
    @endcan
  </ul>
</aside>
