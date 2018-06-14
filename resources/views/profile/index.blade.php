@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil de Usuario        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Perfil de Usuario</li>
      </ol>      
    </section>
    <!-- Main content -->
    <section class="content">
    @if (session('notification-warning'))
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-warning"></i>
      {{ session('notification-warning') }}
    </div>    
    @endif
    @if (session('notification'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-check"></i>
      {{ session('notification') }}        
    </div>      
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>  
    </div>      
    @endif     

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">              
                <img src="{{ Storage::url( Auth::user()->avatar) }}" class="profile-user-img img-responsive img-circle" alt="{{ Auth::user()->name }}">
              
              <h3 class="profile-username text-center">{{ Auth::user()->name_short }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->profile_name }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Incidencias Reportadas</b> <a class="pull-right">{{ $num_incidencias_by_me }}</a>
                </li>
                @if (auth()->user()->is_support)
                <li class="list-group-item">
                  <b>Incidencias Atendidas</b> <a class="pull-right">{{ $num_my_incidencias }}</a>
                </li>
                @endif
                <li class="list-group-item">
                  <b>Total de Incidencias</b> <a class="pull-right">{{ $incident_total }}</a>
                </li>
              </ul>             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Acerca de mi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-at margin-r-5"></i> Correo electrónico</strong>
              <p class="text-muted">
                {{ Auth::user()->email }}
              </p>
              <hr>
              <strong><i class="fa fa-user margin-r-5"></i> Nombre completo</strong>
              <p class="text-muted">
                {{ Auth::user()->name }}
              </p>
              <hr>
              <strong><i class="fa fa-id-card margin-r-5"></i> ID de usuario</strong>
              <a class="text-muted pull-right">{{ Auth::user()->id }}</a>              
              <hr>
              <strong><i class="fa fa-user-secret margin-r-5"></i> Rol de usuario</strong>              
                @if(auth()->user()->is_admin)                
                <span class="pull-right label label-success">{{ Auth::user()->profile_name }}</span>
                @elseif(auth()->user()->is_support)
                <span class="pull-right label label-info">{{ Auth::user()->profile_name }}</span>
                @elseif(auth()->user()->is_client)
                <span class="pull-right label label-primary">{{ Auth::user()->profile_name }}</span>
                @else
                <span class="pull-right label label-warning">{{ Auth::user()->profile_name }}P</span>
                @endif
                @if (auth()->user()->is_support)
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i> Incidencias Resueltas</strong>
              <p class="text-muted">
                Total de Incidencias Resueltas <a class="pull-right">{{ $solve_incidents }}</a>
              </p>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @if(auth()->user()->is_support)
              <li class="active"><a href="#activity" data-toggle="tab">Incidencias Reportadas</a></li>
              @elseif(auth()->user()->is_admin)              
              <li class="active"><a href="#incident" data-toggle="tab">Incidencias</a></li>
              @endif
              <li><a href="#settings" data-toggle="tab">Configuracion</a></li>
            </ul>
            <div class="tab-content">
              @if(auth()->user()->is_support)
              <div class="active tab-pane" id="activity">
                @foreach ($incidents as $incident)
                <p></p>
                <div class="box box-widget">
                  <div class="box-header with-border">
                    <div class="user-block">
                      <img class="img-circle" src="{{ Storage::url( $incident->avatar_client) }}" alt="User Image">
                      <span class="username">{{ $incident->client_name }}</span>
                      <span class="description">ID Incidencia : <a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a></span>
                      <span class="description">Incidencia creada el - {{$incident->created_at->format('d/m/Y')}}</span>
                    </div>                  <!-- /.user-block -->
                    <div class="box-tools">                    
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- post text -->
                    {{$incident->description}}
                  </div>
                  <!-- /.box-body -->
                </div>                          
                @endforeach                 
              </div>
              <!-- /.tab-pane -->
              @elseif(auth()->user()->is_admin)
              <div class="active tab-pane" id="incident">
                @foreach ($incidents as $incident)
                <p></p>
                <div class="box box-widget">
                  <div class="box-header with-border">
                    <div class="user-block">
                      <img class="img-circle" src="{{ Storage::url( $incident->avatar_client) }}" alt="User Image">
                      <span class="username">{{ $incident->client_name }}</span>
                      <span class="description">ID Incidencia :<a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a></span>
                      <span class="description">Incidencia creada el - {{$incident->created_at->format('d/m/Y')}}</span>
                    </div>                  <!-- /.user-block -->
                    <div class="box-tools">                    
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <!-- post text -->
                    {{$incident->description}}
                  </div>
                  <!-- /.box-body -->
                </div>                          
                @endforeach                 
              </div>
              <!-- /.tab-pane -->
              @endif

              <div class="tab-pane" id="settings">
                <form enctype="multipart/form-data" action="perfil/{{$user->id}}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-yellow">
                      <div class="widget-user-image">
                        <img class="img-circle" src="{{ Storage::url( Auth::user()->avatar) }}" alt="User Avatar">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                      <h5 class="widget-user-desc">{{ Auth::user()->profile_name }}</h5>
                      <div class="form-inline">
                        <br>
                        <label for="avatar">Subir Imagen</label>                    
                        <input type="file" name="avatar">
                        
                      </div>                    
                    </div> 
                  </div>
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection