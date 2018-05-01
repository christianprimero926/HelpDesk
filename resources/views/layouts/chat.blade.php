
<!-- DIRECT CHAT SUCCESS -->
<div class="panel-body">
  <div class="box box-success direct-chat direct-chat-success">
    <div class="box-header with-border">
      <h3 class="box-title">Discusión</h3>

      <div class="box-tools pull-right">
        
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
          <i class="fa fa-comments"></i></button>        
      </div>
    </div>
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
    <!-- /.box-header -->
    <div class="box-body">
      <!-- Conversations are loaded here -->

      <div class="direct-chat-messages">
        @foreach ($messages as $message)
          <!-- Message. Default to the left -->
          @if($message->user->id != Auth::user()->id)
          <div class="direct-chat-msg">
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name pull-left">{{ $message->user->name }}</span>
              <span class="direct-chat-timestamp pull-right">{{ $message->created_at }}</span>
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              {{ $message->message }}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
          @endif          
           <!-- Message to the right -->          
          @if($message->user->id == Auth::user()->id)
          <div class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name pull-right">{{ $message->user->name }}</span>
              <span class="direct-chat-timestamp pull-left">{{ $message->created_at }}</span>
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              {{ $message->message }}
            </div>
            <!-- /.direct-chat-text -->
          </div>
          @endif
        @endforeach
        <!-- /.direct-chat-msg -->
      </div>
      <!--/.direct-chat-messages-->

      <!-- Contacts are loaded here -->
      <div class="direct-chat-contacts">
        @foreach ($messages as $message)
        @if($message->user->id != Auth::user()->id)
        <ul class="contacts-list">
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

              <div class="contacts-list-info">
                    <span class="contacts-list-name">

                      {{ $message->user->name }}
                      <small class="contacts-list-date pull-right">{{ $message->created_at }}</small>
                    </span>
                <span class="contacts-list-msg">{{ $message->message }}</span>
              </div>
              <!-- /.contacts-list-info -->
            </a>
          </li>
          <!-- End Contact Item -->
        </ul>
        @endif
        @endforeach
        <!-- /.contatcts-list -->
      </div>
      <!-- /.direct-chat-pane -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <form action="/mensajes" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="incident_id" value="{{ $incident->id }}">
        @if($incident->active)
        <div class="input-group">
          <input type="text" name="message" placeholder="Escribe un Mensaje ..." class="form-control">
              <span class="input-group-btn">                
                <button type="submit" class="btn btn-success btn-flat">Enviar</button>
              </span>
        </div>
        @else
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Ya esta resuelta!</h4>
          Ya se ha resuelto esta incidencia.
        </div>
        @endif
      </form>
    </div>
    <!-- /.box-footer-->
  </div>
</div>

<!--/.direct-chat -->
