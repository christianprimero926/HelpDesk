@extends('layouts.app')
@section('content')
<section class="content-header">
    <h1>Reportar Incidencia<small>Ver Incidencia</small></h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ver Incidencia</li>
    </ol>
</section>
<section class="content">    
    <div class="panel-body">
        @if (session('notification-warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-warning"></i> 
            {{ session('notification-warning') }}
        </div>    
        @endif    
        <div class="box box-primary">    
            <div class="box-header with-border">
              <h3 class="box-title">Ver Detalles de la Incidencia</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center">Código</th>
                            <th style="text-align:center">Proyecto</th>
                            <th style="text-align:center">Categoría</th>
                            <th style="text-align:center">Fecha de envío</th>
                        </tr>                            
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center" id="incident_key">{{ $incident->id }}</td>
                            <td style="text-align:center" id="incident_project">{{ $incident->project_name }}</td>
                            <td style="text-align:center" id="incident_category">{{ $incident->category_name }}</td>
                            <td style="text-align:center" id="incident_created_at">{{ $incident->created_at }}</td>                        
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th style="text-align:center">Asignada a</th>
                            <th style="text-align:center">Nivel</th>
                            <th style="text-align:center">Estado</th>
                            <th style="text-align:center">Severidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center" id="incident_responsible">{{ $incident->support_name }}</td>
                            <td style="text-align:center">{{ $incident->level->name }}</td>
                            <td style="text-align:center" id="incident_state">{{ $incident->state }}</td>
                            <td style="text-align:center" id="incident_severity">{{ $incident->severity_full }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Título</th>
                            <td>{{ $incident->title }}</td>
                        </tr>
                        <tr>
                            <th>Descripcion</th>
                            <td>{{ $incident->description }}</td>
                        </tr>
                        <tr>
                            <th>Adjuntos</th>
                            <td>No se han adjuntado archivos</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
                <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary" id="incident_btn_apply">
                    Atender incidencia
                </a>
                @endif
                @if (auth()->user()->id == $incident->client_id)
                    @if($incident->active)
                    <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-success" id="incident_btn_apply">
                        Marcar como Resuelta
                    </a>
                    <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-info" id="incident_btn_apply">
                        Editar incidencia
                    </a>

                    @else
                    <a href="/incidencia/{{ $incident->id }}/abrir" class="btn bg-orange" id="incident_btn_apply">
                        Volver a abrir incidencia
                    </a>  
                    @endif
                @endif
                @if (auth()->user()->id == $incident->support_id && $incident->active)
                <a href="/incidencia/{{ $incident->id }}/derivar"class="btn btn-danger" id="incident_btn_apply">
                    Derivar al siguiente nivel
                </a>
                @endif
            </div>
        </div>    
    </div>  
@include('layouts.chat')  
</section>
@endsection