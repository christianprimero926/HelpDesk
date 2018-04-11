<!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="/dist/img/avatar.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Elegir Proyecto</li>
          <li>
            <a>
              <i class="fa fa-list-alt"></i>
              <span>
                
                <form>
                  <div class="form-group">
                    <select id="list-of-projects" class="form-control select2" style="width: 85%;">
                      <option value="">Seleccione un proyecto</option>
                    @foreach (auth()->user()->list_of_projects as $project)
                        <option value="{{ $project->id }}" 
                          @if($project->id == auth()->user()->selected_project_id)
                          selected 
                          @endif>
                          {{ $project->name }}
                        </option>
                    @endforeach
                    </select>
                  </div>
                </form>
                              
              </span>            
            </a>          
          </li>

          <li class="header">Menú Principal</li>

          @if(auth()->check())
            <li @if(request()->is('home')) class="active" @endif>
              <a href="/home">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>       

            @if(! auth()->user()->is_client)
            <li @if(request()->is('ver')) class="active" @endif>
              <a href="/ver">
                <i class="fa fa-book"></i>
                <span>Ver incidencias</span>
              </a>
            </li>
            <li @if(request()->is('calendario')) class="active" @endif>
              <a href="/calendario">
                <i class="fa fa-calendar"></i>
                <span>Calendario de asignaciones</span>
              </a>
            </li>        
            @endif

            <li @if(request()->is('reportar')) class="active" @endif>
              <a href="/reportar">
                <i class="fa fa-edit"></i>
                <span>Reportar incidencia</span>
              </a>
            </li>
            
            @if (auth()->user()->is_admin)  
            <li class="treeview">
              <a>
                <i class="fa fa-user-circle"></i> <span>Administración</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>          
              <ul class="treeview-menu">
                <li><a href="/usuarios"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="/proyectos"><i class="fa fa-folder-open"></i> Proyectos</a></li>
                <li><a href="/config"><i class="fa fa-cogs"></i> Configuración</a></li>
                <li><a href="#"><i class="fa fa-users"></i>Crear Perfiles</a></li>
              </ul>            
            </li>             
            @endif
          @endif               
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>