  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Buscador Micrositios</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img 
            {{--src="https://api.adorable.io/avatars/285/{{Auth::user()->email}}.png" --}}
        src="{{Auth::user()->avatar_url}}"
            class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('logout')}}" class="nav-link">
                  <i class="nav-icon fa fa-power-off" aria-hidden="true"></i>
                  <p>
                  Salir
                  </p>
              </a>
          </li>  
          <li class="nav-item has-treeview">
          <a href="{{ route('home')}}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Buscador
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="{{ route('micrositios.listar') }}" class="nav-link {{ Route::is('micrositios.listar') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Micrositios
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ explode('.',Route::currentRouteName())[0]=='usuarios' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ explode('.',Route::currentRouteName())[0]=='usuarios' ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('usuarios.crear')}}" class="nav-link {{ Route::is('usuarios.crear') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('usuarios.listar') }}" class="nav-link {{ Route::is('usuarios.listar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ explode('.',Route::currentRouteName())[0]=='productos' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ explode('.',Route::currentRouteName())[0]=='productos' ? 'active' : '' }}">
              <i class="nav-icon fa fa-cube"></i>
              <p>
                Productos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('productos.crear')}}" class="nav-link {{ Route::is('productos.crear') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('productos.listar') }}" class="nav-link {{ Route::is('productos.listar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ explode('.',Route::currentRouteName())[0]=='servicios' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ explode('.',Route::currentRouteName())[0]=='servicios' ? 'active' : '' }}">
              <i class="nav-icon fa fa-wrench"></i>
              <p>
                Servicios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('servicios.crear')}}" class="nav-link {{ Route::is('servicios.crear') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('servicios.listar') }}" class="nav-link {{ Route::is('servicios.listar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ explode('.',Route::currentRouteName())[0]=='categorias' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ explode('.',Route::currentRouteName())[0]=='categorias' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tags "></i>
              <p>
                Categorias
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('categorias.crear')}}" class="nav-link {{ Route::is('categorias.crear') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('categorias.listar') }}" class="nav-link {{ Route::is('categorias.listar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ explode('.',Route::currentRouteName())[0]=='ventas' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ explode('.',Route::currentRouteName())[0]=='ventas' ? 'active' : '' }}">
              <i class="nav-icon fa fa-money "></i>
              <p>
                Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('ventas.listar') }}" class="nav-link {{ Route::is('ventas.listar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>