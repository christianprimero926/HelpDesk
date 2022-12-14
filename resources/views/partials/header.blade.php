<header class="main-header">
  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>H</b>D</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Help</b>Desk</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">       
        
        
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
              <img src="{{ Storage::url( Auth::user()->avatar) }}" class="user-image" alt="{{ Auth::user()->name }}">
            <span class="hidden-xs">{{ Auth::user()->name_short }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">              
              <img src="{{ Storage::url( Auth::user()->avatar) }}" class="img-circle" alt="{{ Auth::user()->name }}">              
              <p>
                {{ Auth::user()->name_short }} - {{ Auth::user()->profile_name }}
                <small>Miembro desde - {{ Auth::user()->created_at->format('d/m/Y') }}</small>
              </p>
            </li>
            <!-- Menu Body -->
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/perfil" class="btn btn-default btn-flat">Perfil</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                class="btn btn-default btn-flat">Cerrar sesion
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      
    </ul>
  </div>
</nav>
</header>