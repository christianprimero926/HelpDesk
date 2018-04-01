@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>
        Proyectos
        <small>Editar proyecto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
        <li><a href="/proyectos"><i class="fa fa-folder-open"></i>Proyectos</a></li>
        <li class="active">Editar proyecto</li>
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
        <h3 class="box-title">Editar proyecto</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
              <label for="name">Nombre</label>
              <input type="name" name="name" class="form-control" value="{{ old('name', $project->name) }}">
          </div>
          <div class="form-group">
              <label for="description">Descripcion</label>
              <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
          </div>
          <div class="form-group">
              <label for="start">Fecha de inicio</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="start" class="form-control pull-right" id="datepicker" value="{{ old('start', $project->start) }}">
              </div>              
          </div>             
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button class="btn btn-primary">
            <i class="fa fa-plus-square"></i>
          Guardar proyecto</button>     
        </div>
      </form>
      
      <div class="row">
        <div class="col-md-6">
          <div class="box-body">
            <h3>Categorias</h3>
            <form action="/categorias" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <div class="input-group">
                  <input type="text" name="name" placeholder="Ingrese categoria" class="form-control">
                  <div class="input-group-btn">
                    <button class="btn btn-primary">Añadir</button>
                  </div>
                </div>

                
            </form>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>Categoria</th>
                      <th>Opciones</th>  
                  </tr>                      
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                  <tr>
                      <td>{{ $category->name }}</td>                                        
                      <td style="text-align:center">
                        
                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditCategory" title="Editar" data-category="{{ $category->id }}">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </button>                                            
                          <a href="/categorias/{{ $category->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                              <span class="glyphicon glyphicon-trash"></span>
                          </a>
                      </td>
                  </tr>
                  @endforeach                            
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box-body">
            <h3>Niveles</h3>
            <form action="/niveles" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="input-group">
                  <input type="text" name="name" placeholder="Ingrese Nivel" class="form-control">
                  <div class="input-group-btn">
                    <button class="btn btn-primary">Añadir</button>
                  </div>
                </div>
            </form>
            <br>
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Nivel</th>
                      <th>Opciones</th> 
                  </tr>                      
              </thead>
              <tbody>
                @foreach($levels as $key => $level)
                <tr>
                    <td>N{{ $key+1 }}</td>
                    <td>{{ $level->name }}</td>
                    <td style="text-align:center">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditLevel" title="Editar" data-level="{{ $level->id }}">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </button> 
                        <a href="/niveles/{{ $level->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
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
    </div>            
  </div>
</section>

<div class="modal fade" id="modalEditCategory">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Categoria</h4>
      </div>
      <form action="/categorias/editar" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" name="category_id" id="category_id" value="">
          <div class="form-group">
            <label for="name">Nombre de la Categoría</label>
            <input type="text" class="form-control" name="name" id="category_name" value="">
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

<div class="modal fade" id="modalEditLevel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar nivel</h4>
      </div>
      <form action="/niveles/editar" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" name="level_id" id="level_id" value="">
          <div class="form-group">
            <label for="name">Nombre del nivel</label>
            <input type="text" class="form-control" name="name" id="level_name" value="">
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
    <script src="/js/admin/projects/edit.js"></script>
@endsection
