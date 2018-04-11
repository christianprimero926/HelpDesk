<!DOCTYPE html>
<html>
@include('partials.head')
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">      
    @include('partials.header')    
    @include('partials.menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @if (auth()->user()->selected_project_id == null)
        <div class="alert alert-danger">
          <ul>                
            <li>Se requiere escoger un proyecto para ver sus detalles</li>
          </ul>                        
        </div>
      @endif
      <!-- Content Header (Page header) -->
        <!-- /.row -->
      @yield('content')
        <!-- Main row -->        
        <!-- /.row (main row) -->
    </div>
    <!-- /.content-wrapper -->
    @include('partials.config')
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
@include('partials.scripts')
</body>
</html>
