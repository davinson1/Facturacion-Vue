<header class="app-header"><a class="app-header__logo" href="index.html">Vali</a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <li class="app-search">
      <input class="app-search__input" type="search" placeholder="Search">
      <button class="app-search__button"><i class="fa fa-search"></i></button>
    </li>
    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
        <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out fa-lg"></i>{{ __('Salir') }} </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </li>
  </ul>
</header>
