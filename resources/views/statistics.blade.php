<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Reportes y Estadisticas
    <small>Graficas y reportes de la aplicación</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>    
    <li class="active">Reportes y Estadisticas</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div  class="row" >
    <div class="col-md-6">
      <div class="form-group">
        <label>Año</label>
        <select id="anio_sel" class="form-control select2" style="width: 100%;" onchange="cambiar_fecha_grafica();">
          <option value="0" >Seleccione un año</option>          
          <option value="2006" >2006</option>
          <option value="2007" >2007</option>
          <option value="2008" >2008</option>
          <option value="2009" >2009</option>
          <option value="2010" >2010</option>
          <option value="2011" >2011</option>
          <option value="2012" >2012</option>
          <option value="2013" >2013</option>
          <option value="2014" >2014</option>
          <option value="2015" >2015</option>
          <option value="2016" >2016</option>
          <option value="2017" >2017</option>
          <option value="2018">2018</option>
          <option value="2019" >2019</option>
          <option value="2020" >2020</option>
          <option value="2021" >2021</option>
          <option value="2022" >2022</option>
          <option value="2023" >2023</option>
          <option value="2024" >2024</option>
          <option value="2025" >2025</option>
          <option value="2026" >2026</option>
          <option value="2027" >2027</option>
          <option value="2028" >2028</option>
          <option value="2029" >2029</option>
          <option value="2030" >2030</option>
          
        </select>        
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Mes</label>
        <select id="mes_sel" class="form-control select2" style="width: 100%;"  onchange="cambiar_fecha_grafica();">
          <option value="0" >Seleccione un mes</option>          
          <option value="1">ENERO</option>
          <option value="2">FEBRERO</option>
          <option value="3">MARZO</option>
          <option value="4">ABRIL</option>
          <option value="5">MAYO</option>
          <option value="6">JUNIO</option>
          <option value="7">JULIO</option>
          <option value="8">AGOSTO</option>
          <option value="9">SEPTIEMBRE</option>
          <option value="10">OCTUBRE</option>
          <option value="11">NOVIEMBRE</option>
          <option value="12">DICIEMBRE</option>
        </select>
      </div>
    </div>
  </div>
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Registros por mes</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>    
    <div class="box-body" id="div_grafica_lineas">
    </div>    
  </div>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Datos de las incidencias</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>    
    <div class="box-body" id="div_grafica_barras">
    </div>    
  </div>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Modulos incidencias</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>    
    <div class="box-body" id="div_grafica_barras_modules">
    </div>    
  </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
<!-- page script -->
<script>
  cargar_grafica_barras(<?= $anio; ?>,<?= intval($mes); ?>);
  cargar_grafica_lineas(<?= $anio; ?>,<?= intval($mes); ?>);
  cargar_grafica_pie();
</script>
<script src="js/highcharts.js"></script>
<script src="js/graficas.js"></script>
@endsection
