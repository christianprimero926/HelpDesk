@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>
        Reportar Incidencia
        <small>Crear Incidencia</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reportar Incidencia</li>
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
              <h3 class="box-title">Crear Incidencia</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="POST">
              {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="category_id">Categoria:</label>
                  <select name="category_id" class="form-control">
                    <option value="">General</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  
                </div>
                <div class="form-group">
                  <label for="severity">Severidad:</label>
                  <select name="severity" class="form-control">
                    <option value="M">Menor</option>
                    <option value="N">Normal</option>
                    <option value="A">Alta</option>                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="title">Titulo:</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>                
                <div class="form-group">
                  <label for="description">Descripcion:</label>
                  <textarea name="description" class="form-control">
                    {{ old('description') }}
                  </textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                @if (auth()->user()->selected_project_id == null)
                  <a class="btn btn-primary disabled"">Registrar Incidencia</a>
                @else
                <button class="btn btn-primary">Registrar Incidencia</button>
                @endif
              </div>
            </form>
    </div>
  </div>
</section>


@endsection
