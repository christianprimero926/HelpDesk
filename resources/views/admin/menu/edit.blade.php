@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>
    Menú
    <small>Editar Menú</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
    <li><a href="/opciones"><i class="fa fa-bars"></i> Menú</a></li>
    <li class="active">Editar Menú</li>
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
        <h3 class="box-title">Editar Menú</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
            <label>Padre</label>
            
            <select name="id_padre" class="form-control select2" style="width: 100%;">
              <option value="">Seleccione una opción</option>
              @foreach ($menus as $lista)
              <option value="{{ $lista->id }}" @if($lista->id) selected @endif>
                {{ $lista->id }} - 
                {{ $lista->name }} -                           
                ( {{ $lista->name_padre }} ) - 
                {{ $lista->src }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name) }}">
          </div>
          <div class="form-group">
            <label for="src">Ruta</label>
            <input type="text" name="src" class="form-control" value="{{ old('src', $menu->src) }}">
          </div>
          <div class="form-group">
            <label for="orden">Orden</label>
            <input type="text" name="orden" class="form-control" value="{{ old('orden', $menu->orden) }}">
            Orden máximo generado: <label id="label-max-orden">{{$maxOrden}}</label>
          </div>
          <div class="form-group">
            <label for="icon">Icono</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $menu->icon) }}">
            <p>Para mas iconos visitar: <a href="http://fontawesome.io/icons/#web-application" target="blank">Font Awesome</a> </p>
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button class="btn btn-primary">
            <i class="fa fa-save"></i>
            Guardar Cambios
          </button>
        </div>
      </form>           
    </div>
  </div>
</section>
@endsection
@section('scripts')
<script>
  $("#select-id-padre").change(function () {
    OnselectMaxOrden('select-id-padre', 'label-max-orden', 'opciones/hijos/')
  });

  // Función para poner el maximo orden de un padre
  function OnselectMaxOrden(idSelectPadre, labelHijo, ruta) {

    var selectPadre = document.getElementById(idSelectPadre).value;

    // si no se ha seleccionado nada, entonces dejamos el label vacio
    if (!selectPadre) {
      $('#' + labelHijo).html('-');
      return;
    }

    //Función AJAX que cambia los valores de la lista dinamicamente
    $.get(ruta + selectPadre, function (data) {

      //variable que contiene el html que se pondrá en el label
      var html_select = data;

      if (data == '') {
        html_select = '0';
      }

      // cambiamos el html del label
      $('#' + labelHijo).html(html_select)
    });
  }
</script>
@endsection
