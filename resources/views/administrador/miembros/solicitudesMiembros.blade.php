@extends('administrador.app')
@section('content')
 
<div class="container-fluid"> 
  <div class="row-fluid">
    <div class="panel panel-default">
        <div class="panel-heading ">               
          <div ><label >Solicitudes de registro recibidas por los diferentes talleres.</label></div>          
        </div>
        <div class="panel-body">
        @include('includes.succes')
          
          <div class="container" id="admin">
            <table class = "table table-striped table-hover " action="javascript:alert('Submitted')" >
              <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Taller</th>
                <th>Ciudad</th>             
                <th class  = "foo">Acciones</th>          
              </thead>
              <tbody>
                @foreach($solicitudes as $s)
                <tr>
                  <td>{{$s -> nombre}}</td>
                  <td>{{$s -> apellido}}</td>
                  <td>{{$s -> nombreTaller}}</td>
                  <td>{{$s -> ciudad}}</td>                         
                                    
                  <td>
                    <div class="">
                      <a  class="btn btn-info" type="button" class="btn btn-info btn-lg" data-toggle="modal" title="Ver información" data-target="#info-{{$s->id}}"><i class="fa fa-info"></i></a>                        
                      <a  href="#my_modal" data-toggle="modal" data-book-id="{{$s -> id}}" class="btn btn-danger" title ="Borrar Solicitud"><i class="fa fa-trash"  ></i></a>                    
                    </div>
                  </td>                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        
        </div>
    </div>
  </div>
   
</div>

<!--Modal para ver información-->

@foreach($solicitudes as $s)    
<div id="info-{{$s->id}}" class="modal fade " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información de: {{$s->nombre}} {{$s->apellido}}</h4>
      </div>

        <div class="modal-body" > 
        <table class = "table table-striped table-responsive "  >
              <thead>
                <th valign="top" align="center" >Muy Resp.·.Log.·. De Estado Baja California, AA.·.LL.·. y AA.·.MM.·.<br><h5>Calla 9na No. 8169 ofna 302, zona Centro</h5>Gr.·.Or.·. de Tijuena, B.C. Tel: 01-(646)-685-22-72 </th>
                <th><img src="../assets/img/portfolio/Logo1.png" class="img-circle img-responsive" alt="" width="150" height="100"></th>                    
              </thead>
              <tbody>               
                <tr>
                  <td>
                    
                    <img src="../pics_solicitud/{{$s->path}}" class="img-thumbnail img-responsive" alt="" width="150" height="100"> </th>
                    <br> Votar antes del día: {{$s->fechaLim}}

                  </td>                    
                  <td width="55%">
                    <h5><b>LA solicitus fue enviada por:</b></h5>             
                    <ul style="list-style-type:none">   
                      <li><span><b>Taller:</b> {{$s->nombreTaller}}</span></li>
                      <li><span><b>Ciudad:</b> {{$s->ciudad}}</span></li>
                    </ul><br>
                    <h5><b>Datos Personales:</b></h5>  
                    <ul style="list-style-type:none">                
                      <li><b>Profesión:</b> {{$s->profesion}}</li>
                      <li><b>Estado Civil:</b> {{$s->edoCivil}}</li>
                      <li><b>Ingreso Mensual:</b> {{$s->ingresoMen}}</li>
                      <li><b>Teléfono:</b> {{$s->telefono}}</span></li>
                      <li><b>Teléfono Celular:</b> {{$s->telefonoCel}}</li>                      
                      <div >
                      
                        <li ><b>Comentarios Adicionales:</b>{{$s->comentarios}} </li>
                       
                      </div>
                    </ul><br>
                  </td>      
              </tbody>
            </table>             
        </div>              
        <div class="modal-footer ">  
        {!! Form::open(array('action' => array('adminMiembros@enviarAVotacion',$s->id))) !!}   
            <input type="submit" class="btn btn-success" value = "Enviar a Votación">    
            <button type="button" class="btn btn-default "  data-dismiss="modal" > Cerrar</button> 
        {!! Form::close() !!}          
          </div>
        </div>
  </div>
</div>
@endforeach    


<!--Modal Borrar Solicitud-->
 <div class="modal fade" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Estas seguro de Borrar la Solicitud</h4>
      </div>
      {!! Form::open(array('url' => '/admin/aprobaciones/')) !!}
        <div class="modal-body">
          <p>Una vez borrado perderás toda la información! </p>
          <div>
            <i class="fa fa-frown-o fa-5x"></i>
          </div>
          <input  type ="hidden" name="borrarId" value=""/>
        </div>
        <div class="modal-footer">
          <input type="submit" value="Borrar" class="btn btn-danger">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>

@endsection
@section('scripts')
    <script>
       $('#my_modal').on('show.bs.modal', function(e) {
        var borrarId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find('input[name="borrarId"]').val(borrarId);
    });
    </script>

@endsection
@section('scripts')

<!--desaparecer alertas -->

<script type="text/javascript">
  $(document).ready(function() {
      setTimeout(function() {
          $(".alert-success").fadeOut(1500);
      },3000);
  });
</script>


@stop 