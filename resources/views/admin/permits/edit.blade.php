@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>
    Permisos
    <small>Modificar Permisos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a><i class="fa fa-user-circle"></i> Administración</a></li>
    <li><a><i class="fa fa-users"></i> Usuarios</a></li>
    <li class="active">Permisos</li>
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
        <h3 class="box-title">Modificar Permisos</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- /.box-header -->
        <div class="callout callout-info">
          <h4>Permisos a: </h4>
          <p>{{ $profile->name }}</p>
        </div>                  
        <!-- form start -->
        <form action="" method="POST">
          {{ csrf_field() }}
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Seleccione los permisos a modificar</h3>
            </div>
            <div class="box-body">
              {!! $menu !!}
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button class="btn btn-primary">
            <i class="fa fa-save"></i>
          Guardar cambios</button>
        </div>
      </form>            
    </div>
  </div>
</section>
@endsection
@section('scripts')
<!--
  Esta función JQuery consiste en cambiar el estado de un padre o hijo
  * Si se selecciona un hijo debe marcarse su padre
  * si se selecciona un padre deden marcarse los hijos
-->
<script>
  $(function () {
    $(".autoCheckbox").on("click",function () {
      var expr="li input[type=checkbox]",$this=$(event.target);
      while ($this.length) {
        $input=$this.closest("li").find(expr);
        if ($input.length) {
          if ($this[0]==event.target) {
            checked = $this.prop("checked");
            $input.prop("checked", checked).css("opacity","1.0");
          }
          checked=$input.is(":checked");
          $this.prop("checked", checked).css("opacity",
            (checked && $input.length!= $this.closest("li").find(expr+":checked").length)
            ? "0.5" : "1.0");
        }
        $this=$this.closest("ul").closest("li").find(expr.substr(3)+":first");
      }
    });
  })
</script>
@endsection
