@extends('administrador.app')
@section('content')
 
<div class="container-fluid"> 
  <div class="row-fluid">
    <div class="panel panel-default">
        <div class="panel-heading ">               
          <div ><label >Solicitudes de ingreso  </label></div>          
        </div>
        <div class="panel-body">
           @include('includes.succes')          
          <div class="container" id="admin">
            <table class = "table table-striped table-hover " action="javascript:alert('Submitted')" >
              <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Taller</th>
                <th>Oriente de</th>         
                         
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
                      <a  class="btn btn-info" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#info-{{$s->id}}"><i class="fa fa-info"></i></a>                                       
                        <a  class="btn btn-success"  type="button" data-toggle="modal" data-target="#votar-{{$s->id}}"  ><i class="fa fa-check-square-o"></i></a>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



<!-- Modal Información del Solicitante-->
@foreach($solicitudes as $s)                    

<div id="info-{{$s->id}}" class="modal fade " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información de: {{$s->nombre}}  {{$s->apellido}}</h4>
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
                      
                      <div id="element" >
                        <li ><b>Comentarios Adicionales:</b> {!!$s->comentarios!!}</li>
                        
                      </div>
                    </ul><br>
                  </td>      
              </tbody>
            </table>       
        </div>              
        <div class="modal-footer ">        
            <button type="button" class="btn btn-default "  data-dismiss="modal" > Cerrar</button>          
          </div>
        </div>
             

  </div>
</div>
@endforeach

<!-- Modal Para Votar -->
@foreach($solicitudes as $s)                    
<div id="votar-{{$s->id}}" class="modal fade " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Información de: {{$s->nombre}}</h4>
      </div>

        <div class="modal-body" > 
        {!!  Form::open(array('action' => array('venerableController@enviarVotacion', $s->id, Auth::user()->id_taller )))  !!}
            <h4>Estatus del Neófito:</h4>
            <span><input type="radio" name="voto" value="conocido" checked > Conocido </span>
            <span><input type="radio" name="voto" value="desconocido"> Desconocido </span><br>

            <h4>Comentarios adicionales:</h4>
            <textarea name="comentarios" class = "form-control" rows="10" cols="50" placeholder></textarea>    

        </div>              
        <div class="modal-footer ">        
            <button type="button" class="btn btn-default "  data-dismiss="modal" >Cerrar</button>        
            <input type="submit" class="btn btn-success" value = "Enviar a Votación"> 
        </div>
        {!!Form::close()!!}
    </div>
             

  </div>
</div>
@endforeach



@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    $("#hide").click(function(){
      $("#element").slideUp();
    });
    $("#show").click(function(){
      $("#element").slideDown();
    });
  });
</script>
@endsection
  <!--desaparecer alertas -->
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
      setTimeout(function() {
          $(".alert-success").fadeOut(1500);
      },3000);
  });
</script>
@endsection
     

@stop 

