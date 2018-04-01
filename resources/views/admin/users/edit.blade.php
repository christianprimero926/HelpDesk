@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>
        Usuarios
        <small>Editar usuario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
        <li><a href="/usuarios"><i class="fa fa-users"></i>Usuarios</a></li>
        <li class="active">Editar Usuario</li>
      </ol>
</section>
<section class="content">
  <div class="panel-body">
    @if (session('notification'))
    <div class="alert alert-success">
        {{ session('notification') }}                      
    </div>
    @endif
    @if (session('notification-warning'))
    <div class="alert alert-warning">
        {{ session('notification-warning') }}                      
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>                        
    </div>
    @endif
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Usuario</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="POST">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" readonly value="{{ old('email', $user->email) }}">
                </div>
                <br>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div> 
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                </div>              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary">
                  <i class="fa fa-user-plus"></i>
                Guardar Usuario
              </button>                
              </div>
            </form>

            <form action="/proyecto-usuario" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                      <select name="project_id" class="form-control select2" id="select-project" style="width: 100%;">
                        <option value="">Seleccione Proyecto</option>
                        @foreach ($projects as $project)                      
                          <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                      </select>                    
                  </div>
                  <div class="col-md-4">                    
                      <select name="level_id" class="form-control select2" id="select-level" style="width: 100%;">
                        <option value="">Seleccione Nivel</option>                      
                      </select>                  
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary">
                      <i class="fa fa-plus"></i>
                      Asignar Proyecto
                    </button>
                  </div>
                </div>
              </div>
            </form>

            
            
            <div class="box-body">
              <h3>Proyectos asignados</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Proyecto</th>
                        <th>Nivel</th>
                        <th>Opciones</th> 
                    </tr>                            
                </thead>
                <tbody>
                    @foreach ($projects_user as $project_user)
                    <tr>
                        <td>{{ $project_user->project->name }}</td>
                        <td>{{ $project_user->level->name }}</td>
                        <td style="text-align:center">      
                            <a href="/proyecto-usuario/{{ $project_user->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach                          
                </tbody>
              </table>
            </div>
    </div>
  </div>
</section>


@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection