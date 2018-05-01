@extends('layouts.app')

@section('content')
<section class="content-header">
      <h1>
        Usuarios
        <small>Roles de Usuario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
        <li class="active">Roles de Usuario</li>
      </ol>
</section>
<section class="content">
  	<div class="panel-body">
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
	    <div class="box box-primary">              
	      <div class="box-header with-border">              
	        <h3 class="box-title">Roles de usuario</h3>
	      </div>
	      <form action="" method="POST">
	      {{ csrf_field() }}              
	        <div class="box-body">
				<div class="form-group">
				  <label for="name">Nombre del perfil</label>
				  	<div class="input-group">
				      <input type="text" name="name" class="form-control" value="{{ old('name') }}">
				      <div class="input-group-btn">
				        <button class="btn btn-primary">
				            <i class="fa fa-user-plus"></i>
				            Crear nuevo perfil
				        </button>
				      </div>
					</div>                      
				</div>
	        </div>
	        <!-- /.box-body -->
	      </form>
	      <div class="box-body">
	        <table id="example1" class="table table-bordered table-striped">
	          <thead>
	              <tr>                          
	                  <th>Nombre</th>          
	                  <th>Opciones</th> 
	              </tr>                            
	          </thead>
	          <tbody>
	            @foreach ($profiles as $profile)                      
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
	            @endforeach                           
	          </tbody>
	        </table>
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