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
        <h3 class="box-title">Crear Incidencia</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="" method="POST">
        {{ csrf_field() }}
        <div class="box-body">

          <div class="form-group">
            <label for="category_id">Modulo:</label>
            <select name="category_id" class="form-control select2" style="width: 100%;">
              <option value="">Seleccione una opción</option>                      
              @foreach ($categories as $category)                                           
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="severity">Severidad:</label>
            <select name="severity" class="form-control select2" style="width: 100%;">
              <option value="M">Menor</option>
              <option value="N">Normal</option>
              <option value="A">Alta</option>
            </select>
          </div>                 
          
          <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" name="title" class="form-control" placeholder="Escriba un titulo aqui..." value="{{ old('title') }}">
          </div> 

          <div class="form-group">
            <label for="description">Descripcion:</label>
            <textarea name="description" class="form-control" placeholder="Escriba una breve descripción..."></textarea>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          @if (auth()->user()->selected_project_id == null)
          <a class="btn btn-primary disabled"">
            <i class="fa fa-plus-circle"></i>
          Registrar Incidencia</a>
          @else
          <button class="btn btn-primary">
            <i class="fa fa-plus-circle"></i>
            Registrar Incidencia
          </button>
          @endif
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
