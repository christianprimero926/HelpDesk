@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>
        Proyectos
        <small>Crear proyecto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-folder-open"></i> Administración</a></li>
        <li class="active">Crear proyecto</li>
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
              <h3 class="box-title">Crear proyecto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="POST">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label for="description">Descripción</label>                  
                  <textarea name="description" class="form-control">{{ old('description') }}</textarea>                            
                </div>
                <div class="form-group">
                    <label for="start">Fecha de inicio</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="start" class="form-control pull-right" id="datepicker" value="{{ old('start', date('d/m/Y')) }}">
                    </div>              
                </div>      
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary">
                  <i class="fa fa-plus-square"></i>
                Registrar proyecto</button>
              </div>
            </form>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fecha de inicio</th>
                        <th>Opciones</th> 
                    </tr>                            
                </thead>
                <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description_short }}</td>
                                <td>{{ $project->start ?: 'No se ha indicado' }}</td>
                                <td style="text-align:center">                                    
                                    @if($project->trashed())
                                      <a href="/proyectos/{{ $project->id }}/restaurar" class="btn btn-sm btn-success" title="Restaurar">
                                          <i class="fa fa-undo"></i>
                                      </a>
                                    @else
                                      <a href="/proyectos/{{ $project->id }}" class="btn btn-sm btn-primary" title="Editar">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="/proyectos/{{ $project->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                                          <i class="fa fa-trash"></i>
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


@endsection
