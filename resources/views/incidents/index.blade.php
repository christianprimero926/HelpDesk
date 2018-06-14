@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>
    Incidencias
    <small>Ver Incidencias</small>
  </h1>
  <ol class="breadcrumb">        
    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> Ver incidencias</li>
  </ol>
</section>
<section class="content">
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
  <div class="box-body">
    <div class="row">
     
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Incidencias reportadas</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Código</th>                    
                  <th>Modulo</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                  <th>Reportada por</th>
                  <th>Responsable</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($incidents as $incident)
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
                  <td>{{ $incident->client_name }} - {{ $incident->profile_name }}</td>
                  <td>{{ $incident->support_name }}</td>
                  <td style="text-align:center">
                    @if($incident->support_id == null)                        
                    <button  type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAssignIncident" title="Asignar incidencia" data-incident="{{ $incident->id }}">                          
                      Asignar
                    </button>                      
                    @else
                    <button  type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAssignIncident" title="Reasignar incidencia" data-incident="{{ $incident->id }}">                          
                      Reasignar
                    </button>
                    @endif
                  </td>                      
                </tr>
                @endforeach                
              </tbody>
              <tfoot>
                <tr>
                  <th>Código</th>                    
                  <th>Modulo</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                  <th>Reportada por</th>
                  <th>Responsable</th>
                  <th>Opciones</th>
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

<div class="modal fade" id="modalAssignIncident">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Asignar a:</h4>
        </div>
        <form action="/ver/asignar" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="hidden" name="incident_id" id="incident_id" value="">         
            <div class="form-group">
              <label for="support_id">Seleccione el usuario a asignar:</label>            
              <select name="support_id" id="support_id" class="form-control select2" style="width: 100%;">
                <option value="">Seleccione una opción</option>                      
                @foreach ($users as $user)                                           
                <option value="{{ $user->id }}" @if($user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Asignar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
  </div>
  @endsection
  @section('scripts')
  <script src="/js/admin/incidents/assign.js"></script>
  @endsection