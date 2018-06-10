<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    ChartJS
    <small>Preview sample</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Charts</a></li>
    <li class="active">ChartJS</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div  class="row" >
    <div class="col-md-6">
      <div class="form-group">
        <label>Año</label>
        <select name="" class="form-control" style="width: 100%;" id="anio_sel"  onchange="cambiar_fecha_grafica();">
          
          <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
          <option value="2015" >2015</option>
          <option value="2016" >2016</option>
          <option value="2017" >2017</option>
          <option value="2018">2018</option>
          <option value="2019" >2019</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Mes</label>
        <select name="" class="form-control" style="width: 100%;" id="mes_sel" onchange="cambiar_fecha_grafica();">
          
          <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
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

  <div class="row">
    <br/>
  <div class="box box-primary">
    <div class="box-header">
    </div>

    <div class="box-body" id="div_grafica_barras">
    </div>

      <div class="box-footer">
    </div>
  </div>
   
    <div class="col-md-6">
      <!-- AREA CHART -->
      <div class="box box-primary">
        <div class="box-header">
        </div>

        <div class="box-body" id="div_grafica_barras">
        </div>

        <div class="box-footer">
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Area Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="box-body" id="div_grafica_lineas">
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- DONUT CHART -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Donut Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <canvas id="pieChart" style="height:250px"></canvas>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
      <!-- LINE CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Line Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="lineChart" style="height:250px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Bar Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
  </div>
  <!-- /.row -->

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
@endsection
