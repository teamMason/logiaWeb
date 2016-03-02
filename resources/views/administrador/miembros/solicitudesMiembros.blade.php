@extends('administrador.app')
@section('content')
 
<div class="row">
  <div class="container">
    <div class="panel panel-default ">
        <div class="panel-heading ">               
          <div ><label >Solicitudes de registro recibidas por los diferentes talleres.</label></div>          
        </div>
        <div class="panel-body">
        @include('includes.succes')
          

            <table class = "table table-striped table-hover table-responsive" action="javascript:alert('Submitted')" >
              <thead>
                <th>Nombre</th>
                <th>Taller</th>
                <th>Ciudad</th>             
                <th class  = "foo">Acciones</th>          
              </thead>
              <tbody>
                @foreach($solicitudes as $s)
                <tr>
                  <td>{{$s -> nombre}} {{$s -> apellido}}</td>
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
            <div class="row">

                <div class="col-md-4" align="center">
                    <th><img src="../assets/img/portfolio/Logo1.png" class="img-circle img-responsive" alt="" width="150" height="100"></th>
                </div>
                <div class="col-md-8 text-center">
                    <p>Muy Resp.·.Log.·. De Estado Baja California, AA.·.LL.·. y AA.·.MM.·.</p>
                    <p>Calla 9na No. 8169 ofna 302, zona Centro Gr.·.Or.·. de Tijuena, B.C. Tel: 01-(646)-685-22-72</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="container-fluid">
                    <div class="col-md-8">
                        <strong><p>La Solicitud fue enviada por:</p></strong>{{$s->nombreTaller}}
                        <strong><p>Ciudad:</p></strong>{{$s->ciudad}}
                        <div id="personalDates">
                            <h5>Datos Personales:</h5>
                            <ul style="">
                                <li><strong class="hidden-xs">Profesión: </strong> {{$s->profesion}}</li>
                                <li> <strong class="hidden-xs">Estado Civil: </strong> {{$s->edoCivil}}</li>
                                <li><strong class="hidden-xs">Ingreso Mensual: </strong> {{$s->ingresoMen}}</li>
                                <li><strong class="hidden-xs">Teléfono: </strong> {{$s->telefono}}</li>
                                <li> <strong class="hidden-xs">Teléfono Celular: </strong> {{$s->telefonoCel}}</li>
                                <li> <strong class="hidden-xs">Comentarios: </strong> {{$s->comentarios}}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-4">
                        <img src="../fotos_solicitud/{{$s->path}}" class="img-thumbnail img-responsive" alt="" width="150" height="100">
                        <p>Votar antes del día: {{$s->fechaLim}}</p>
                    </div>
                </div>
            </div>
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