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
    <div class="box box-primary">
            <div class="box-header with-border">
              <div class="row">
                <div class="col-md-6">
                  <h3 class="box-title">Registrar Usuario</h3>
                </div>
                <div class="col-md-6">
                  <h3 class="box-title">Crear Nuevo Perfil</h3>
                </div>                
              </div>              
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
                      <select class="form-control select2" style="width: 100%;">
                        <option value="">Seleccione Perfil</option>
                      @foreach ($profiles as $profile)                      
                        <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                      @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Opciones a asignar</label>
                      <select class="form-control select2" multiple="multiple" data-placeholder="Seleccionar Opciones"
                              style="width: 100%;">
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
                            <td>{{ $user->profile_id }}</td>
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
 
</section>


@endsection
