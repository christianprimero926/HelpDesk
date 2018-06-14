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
        <img src="{{ Storage::url( Auth::user()->avatar) }}" class="img-circle" alt="{{ Auth::user()->name }}" title="Imagen de perfil">
      </div>
      <div class="pull-left info">
        <br>
        <p><a href="/perfil">{{ Auth::user()->name_short }}</a></p>        
      </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Elegir Empresa</li>
      <li class="form-inline">
        <a>
          <i class="fa fa-list-alt"></i>
          <span>
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
          </span>
        </a>
      </li>            
      <li class="header">Menú Principal</li>
      @if(auth()->check())
      <li @if(request()->is('home')) class="active" @endif>
        <a href="/home">
          <i class="fa fa-dashboard"></i>
          <span>Panel Principal</span>
        </a>
      </li>
      <!--
      <li @if(request()->is('correo')) class="active" @endif>
        <a href="/correo">
          <i class="fa fa-inbox"></i>
          <span>Bandeja de entrada</span>
        </a>
      </li>
    -->
      <!-- Llamamos a la variable que contiene el menú -->
      {!! $menu !!}
      @endif               
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>