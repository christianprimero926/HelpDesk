<?php
use App\Http\Controllers\Admin\MenuController;

/** @var  $userLogeado Usuario actual en el sistema */
$userLogeado = Auth::user()->profile_id;
/** @var  $menu Menu asignado al rol */
$menu = MenuController::construirMenu(0, $userLogeado);


?>
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
            <li @if(request()->is('correo')) class="active" @endif>
              <a href="/correo">
                <i class="fa fa-inbox"></i>
                <span>Bandeja de entrada</span>
              </a>
            </li>       
           
            
            <!-- Llamamos a la variable que contiene el menú -->
            {!! $menu !!}
            

          @endif               
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>