@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endsection
@section('content')

<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">        
    <li class="active">Dashboard</li>
  </ol>
</section>
<section class="content">
  <div class="box-body">
    @if (session('notification-warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-warning"></i> 
        {{ session('notification-warning') }}
    </div>    
    @endif
    <div class="row">
      @if (auth()->user()->is_support)
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Incidencias Asignadas a mí</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                </tr>
              </thead>
              <tbody id="dashboard_my_incidents">
                @foreach ($my_incidents as $incident)
                <tr>
                  <td style="text-align:center">
                    <a href="/ver/{{ $incident->id }}">
                      {{ $incident->id }}
                    </a>
                  </td>
                  <td>{{ $incident->category->name }}</td>
                  <td>{{ $incident->severity_full }}</td>
                  <td>{{ $incident->state }}</td>
                  <td>{{ $incident->created_at }}</td>
                  <td>{{ $incident->title_short }}</td>                              
                  
                </tr>
                @endforeach                
              </tbody>
              <tfoot>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Incidencias sin asignar</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tabla1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha de Creación</th>
                  <th>Título</th>
                  <th>Opción</th>
                </tr>
              </thead>
              <tbody id="dashboard_pending_incidents">
                @foreach ($pending_incidents as $incident)
                <tr>
                  <td style="text-align:center">
                    <a href="/ver/{{ $incident->id }}">
                      {{ $incident->id }}
                    </a>
                  </td>
                  <td>{{ $incident->category->name }}</td>
                  <td>{{ $incident->severity_full }}</td>
                  <td>{{ $incident->state }}</td>
                  <td>{{ $incident->created_at }}</td>
                  <td>{{ $incident->title_short }}</td> 
                  <td style="text-align:center">
                    <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-sm btn-primary">
                      Atender
                    </a>
                  </td>                               
                </tr>
                @endforeach                                              
              </tbody>
              <tfoot>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha de Creación</th>
                  <th>Título</th>
                  <th>Opción</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      @endif
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Incidencias reportadas por mi</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tabla2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>                 
                  <th>Responsable</th>
                </tr>
              </thead>
              <tbody id="dashboard_by_me">
                @foreach ($incidents_by_me as $incident)
                <tr>
                  <td style="text-align:center">
                    <a href="/ver/{{ $incident->id }}">
                      {{ $incident->id }}
                    </a>
                  </td>
                  <td>{{ $incident->category_name }}</td>
                  <td>{{ $incident->severity_full }}</td>
                  <td>{{ $incident->state }}</td>
                  <td>{{ $incident->created_at }}</td>
                  <td>{{ $incident->title_short }}</td>
                  <td>{{ $incident->support_name }}</td>
                </tr>
                @endforeach                                                       
              </tbody>
              <tfoot>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>                 
                  <th>Responsable</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  </div>
</section>


@endsection
@section('scripts')
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>



  <script type="text/javascript">

    $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5', 'print'
      ]
    } );
    $('#tabla1').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5', 'print'
      ]
    } );
    $('#tabla2').DataTable( {
      dom: 'Bfrtip',
      buttons: [
      'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5', 'print'
      ]
    } );

  </script>
  @endsection