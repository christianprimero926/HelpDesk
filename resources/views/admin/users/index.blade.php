@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>
        Usuarios
        <small>Registrar Usuario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
        <li class="active">Registrar Usuario</li>
      </ol>
</section>
<section class="content">
  <div class="panel-body">
    @if (session('notification'))
        <div class="alert alert-success">
            {{ session('notification') }}                      
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
        <div class="row">
          <div class="col-md-6">
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
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="E-mail">
                  </div>
                  <br>

                  <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                  </div> 
                  <div class="form-group">
                      <label for="password">Contraseña</label>
                      <input type="text" name="password" class="form-control" value="{{ old('password', str_random(8)) }}">
                  </div>
                  <div class="form-group">
                    <label>Perfil</label>
                    <select name="profile_id" class="form-control select2" style="width: 100%;">
                      <option value="">Seleccione Perfil</option>                      
                      @foreach ($profiles as $profile)
                        @if( $profile->id != 1 && $profile->id != 3)                      
                          <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Opciones a asignar</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Seleccionar Opciones" style="width: 100%;">
                      <option>Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-primary">
                    <i class="fa fa-user-plus"></i>
                  Registrar Usuario</button>
                </div>
              </form>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>E-mail</th>
                          <th>Nombre</th>
                          <th>Perfil</th>
                          <th>Opciones</th> 
                      </tr>                            
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                      <tr>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->profile->name }}</td>
                          <td style="text-align:center">
                              <a href="/usuarios/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar">
                                  <i class="fa fa-edit"></i>
                              </a>
                              <a href="/usuarios/{{ $user->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                                  <span class="fa fa-user-times"></span>
                              </a>
                          </td>
                      </tr> 
                      @endforeach                           
                  </tbody>
                </table>
              </div>                
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-primary">              
              <div class="box-header with-border">              
                <h3 class="box-title">Crear Nuevo Perfil</h3>
              </div>
              <form action="/perfiles" method="POST">
              {{ csrf_field() }}              
                <div class="box-body">
                  <div class="form-group">
                      <label for="name">Nombre del perfil</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-primary">
                    <i class="fa fa-user-plus"></i>
                  Crear nuevo perfil</button>
                </div>
              </form>
              <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                      <tr>                          
                          <th>Nombre</th>                          
                          <th>Opciones</th> 
                      </tr>                            
                  </thead>
                  <tbody>
                    @foreach ($profiles as $profile)
                      @if( $profile->id != 1 && $profile->id != 3)
                      <tr>
                          <td>{{ $profile->name }}</td>
                          <td style="text-align:center">
                            @if($profile->trashed())
                              <a href="/perfiles/{{ $profile->id }}/restaurar" class="btn btn-sm btn-success" title="Restaurar">
                                  <i class="fa fa-undo"></i>
                              </a>
                            @else
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditProfile" title="Editar" data-profile="{{ $profile->id }}">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                              
                              <a href="/perfiles/{{ $profile->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                                  <span class="fa fa-user-times"></span>
                              </a>
                            @endif
                          </td>
                      </tr> 
                      @endif
                    @endforeach                           
                  </tbody>
                </table>
              </div>                              
            </div>
          </div>
        </div>
      </div> 
</section>

<div class="modal fade" id="modalEditProfile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Perfil</h4>
      </div>
      <form action="/perfiles/editar" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" name="profile_id" id="profile_id" value="">
          <div class="form-group">
            <label for="name">Nombre del perfil</label>
            <input type="text" class="form-control" name="name" id="profile_name" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection
@section('scripts')
    <script src="/js/admin/profiles/edit.js"></script>
@endsection
