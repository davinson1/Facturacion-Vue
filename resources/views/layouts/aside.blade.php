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
    @can('modulo-usuarios')
      <li class="treeview @yield('menu-open-usuarios')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @can('ver usuario')
            <li>
              <a class="treeview-item @yield('active-usuario')" href="usuarios"><i class="icon fa  fa-user-friends"></i> Usuarios</a>
            </li>
          @endcan
          @can('ver rol')
            <li>
              <a class="treeview-item @yield('active-rol')" href="roles"><i class="icon fa fa-user-tag"></i> Roles</a>
            </li>
          @endcan
          @can('ver tipo-documento')
            <li>
              <a class="treeview-item @yield('active-tipo-documento')" href="tipoDocumentos"><i class="icon fa fa-id-card"></i> Tipo de documento</a>
            </li>
          @endcan
          @can('ver empresa')
            <li>
              <a class="treeview-item @yield('active-empresa')" href="empresa"><i class="icon fa fa-building"></i> Empresa</a>
            </li>
          @endcan
        </ul>
      </li>
    @endcan
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
    @can('modulo-productos')
      <li class="treeview @yield('menu-open-producto')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-shopping-cart"></i><span class="app-menu__label">Productos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @can('ver proveedor')
            <li>
              <a class="treeview-item @yield('active-proveedor')" href="proveedores"><i class="icon fas fa-truck"></i> Proveedores</a>
            </li>
          @endcan
          @can('ver categoria')
            <li>
              <a class="treeview-item @yield('active-categoria')" href="categorias"><i class="icon fas fa-shopping-cart"></i> Categorias de Productos</a>
            </li>
          @endcan
          @can('ver producto')
            <li>
              <a class="treeview-item @yield('active-producto')" href="productos"><i class="icon fas fa-shopping-basket"></i> Productos</a>
            </li>
          @endcan
          @can('ver tipo-articulo')
            <li>
              <a class="treeview-item @yield('active-tipo-articulo')" href="tipoArticulos"><i class="icon fas fa-shopping-basket"></i> Tipos de artículos</a>
            </li>
          @endcan
          @can('ver forma-pago')
            <li>
              <a class="treeview-item @yield('active-forma-pago')" href="formaPagos"><i class="icon fas fa-cash-register"></i> Formas de pago</a>
            </li>
          @endcan
          @can('ver iva')
            <li>
              <a class="treeview-item @yield('active-iva')" href="ivas"><i class="icon fas fa-file-invoice-dollar"></i> Iva</a>
            </li>
          @endcan
          @can('ver porcentaje')
            <li>
              <a class="treeview-item @yield('active-porcentaje')" href="porcentajes"><i class="icon fas fa-percentage"></i> Porcentaje</a>
            </li>
          @endcan
          @can('ver tipo-factura')
            <li>
              <a class="treeview-item @yield('active-tipo-factura')" href="tipoFacturas"><i class="icon fas fa-receipt"></i> Tipos de facturas</a>
            </li>
          @endcan
          @can('ver tipo-tributario')
            <li>
              <a class="treeview-item @yield('active-tipo-tributario')" href="tipoTributarios"><i class="icon fas fa-gavel"></i> Tipos tributarios</a>
            </li>
          @endcan
        </ul>
      </li>
    @endcan
    @can('modulo-compras')
      <li class="treeview @yield('menu-open-compra')"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-money-check-alt"></i><span class="app-menu__label">Compras</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          @can('ver tipo-compra')
            <li>
              <a class="treeview-item @yield('active-tipo-compra')" href="tipoCompras"><i class="icon fas fa-store-alt"></i> Tipo compra</a>
            </li>
          @endcan
          @can('ver compra')
            <li>
              <a class="treeview-item @yield('active-compra')" href="compras"><i class="icon fas fa-store"></i> Realizar compras</a>
            </li>
          @endcan
          @can('ver consultar-compra')
            <li>
              <a class="treeview-item @yield('active-consultar-compra')" href="consultarCompras"><i class="icon fas fa-shopping-bag"></i> Consultar compras</a>
            </li>
          @endcan
          @can('ver abono-compra')
            <li>
              <a class="treeview-item @yield('active-abono-compra')" href="abonoCompras"><i class="icon fas fa-file-invoice-dollar"></i> Abono de compras</a>
            </li>
          @endcan
        </ul>
      </li>
    @endcan
    @can('modulo-datos-empresa')
      <li>
        <a class="app-menu__item" href="datoEmpresa"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Datos de empresa</span></a>
      </li>
    @endcan
  </ul>
</aside>
