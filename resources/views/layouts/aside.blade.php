<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
      <div>
        <p class="app-sidebar__user-name" > {{ Auth::user()->name }}</p>
        <p class="app-sidebar__user-designation">Rol:</p>
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
    </ul>
  </aside>
