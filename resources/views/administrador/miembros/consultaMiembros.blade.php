@extends('administrador.app')
@section('content')
 
<div class="container-fluid"> 
  <div class="row-fluid">
    <div class="panel panel-default">
        <div class="panel-heading ">               
          <strong style="margin-right: 15px;"> Miembros registrados de los diferentes talleres.</strong> <strong>Hay {{$miembros->total()}} Registros  </strong>

        </div>
        <div class="panel-body">
            @include('includes.succes')
            @include('includes.errors')
            <div class="container" id="admin">
              <div class="row">
                  {!!Form::model(Request::only(['typeBusqueda', 'subBusqueda']),['method' => 'GET', 'route'=>'consulta', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'id' => 'buscador'])!!}

                  <div class="form-group">
                      {!! Form::select('typeBusqueda', config('options.types'), Input::old('typeBusqueda'), array('class' => 'form-control')) !!}
                  </div>
                  <div class="form-group">
                      <?php $l =  portalLogia\Taller::lists('nombreTaller', 'id')->toArray(); array_unshift($l, 'Todos los Talleres'); ?>
                      {!! Form::select('subBusqueda',$l, null, array('class' => 'form-control'))!!}
                  </div>
                  <button type="submit" class="btn btn-info">Buscar</button>
                  {!!Form::close()!!}
              </div>

              <hr>
              <div class="row">

                  <table class = "table table-striped table-hover " >
                      <thead>
                      <th>Nombre y Apellido</th>
                      <th>Taller</th>
                      <th class="hidden-sm hidden-xs">Grado</th>
                      <th class="hidden-sm hidden-xs">Cargo</th>
                      <th class="hidden-md hidden-sm hidden-xs">Miembro Libre</th>
                      <th class="hidden-md hidden-sm hidden-xs">Voto en G.·.L.·.</th>
                      <th class="hidden-md hidden-sm hidden-xs">Estado</th>
                      </thead>
                      <tbody>
                      @foreach($miembros as $s)
                          <tr>
                              <td>{{$s -> nombre}} {{$s -> apellido}}</td>
                              <td>{{$s -> nombreTaller}}</td>
                              <td class=" hidden-sm hidden-xs">{{$s -> grado}}</td>
                              <td class=" hidden-sm hidden-xs">{{$s -> cargo}}</td>
                              <td class="hidden-md hidden-sm hidden-xs">{{$s -> mlibre}}</td>
                              <td class="hidden-md hidden-sm hidden-xs">{{$s -> voto}}</td>
                              <td class="hidden-md hidden-sm hidden-xs">{{$s -> estado}}</td>
                              <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default dropdown-toggle"
                                              data-toggle="dropdown">
                                          <span class="caret"></span>
                                      </button>

                                      <ul class="dropdown-menu" role="menu">
                                          <li><a data-toggle="modal" title="Editar información" data-target="#infoEdit-{{$s->id}}">Editar</a></li>
                                          <li><a data-toggle="modal" title="Ver información" data-target="#info-{{$s->id}}">Ver</a></li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
        <div class="container" align = "center">
            <?php
            echo $miembros ->appends(Request::only(['typeBusqueda', 'subBusqueda']))-> render()
            ?>

        </div>

        </div>
    </div>
  </div>

</div>

<!--Modal para ver información-->

@foreach($miembros as $s)
<div id="info-{{$s->id}}" class="modal fade modal " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Información de: {{$s->nombre}} {{$s->apellido}}</h4>
        </div>
        <div class="modai-body" align="center">
            <img src="../../assets/img/portfolio/Logo1.png" class="img-circle img-responsive" alt="" width="150" height="100">
        </div>
        <div class="container-fluid">
            <div class="modal-body" >

                <p valign="top" align="center" >Muy Resp.·.Log.·. De Estado Baja California, <br> AA.·.LL.·. y AA.·.MM.·. Calla 9na No. 8169 ofna 302, zona Centro
                    <br> Gr.·.Or.·. de Tijuena, B.C. Tel: 01-(646)-685-22-72 </p>

                <h5><b>Pertenece al Taller:</b></h5>
                <ul style="list-style-type:none">
                    <li><span><b>Taller:</b> {{$s->nombreTaller}}</span></li>
                    <li><span></span></li>
                </ul><br>
                <h5><b>Datos Importantes:</b></h5>
                <ul style="list-style-type:none">
                    <li><b>Cargo:</b> {{$s->cargo}} </li>
                    <li><b>Grado:</b> {{$s->grado}}</li>
                    <li><b>Miembro Libre:</b> {{$s->mlibre}}</li>
                    <li><b>Voto en G.·.L.·.:</b> {{$s->voto}}</li>
                    <li><b>Estado Actual:</b> {{$s->estado}}</li>
                </ul><br>
            </div>
        </div>
        <div class="modal-footer ">
        {!! Form::open(array('action' => array('adminMiembros@enviarAVotacion',$s->id))) !!}
            <button type="button" class="btn btn-default "  data-dismiss="modal" > Cerrar</button>
        {!! Form::close() !!}
          </div>
        </div>
  </div>
</div>
@endforeach

        <!--Modal editar información-->

@foreach($miembros as $s)
    <div id="infoEdit-{{$s->id}}" class="modal fade " role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Información de: {{$s->nombre}} {{$s->apellido}}</h4>
                </div>

                <div class="modal-body" >
                    {!! Form::model(Request::all(),array('action' => array('adminMiembros@actualizaMiembros',$s->id)),['method' => 'post'])!!}
                    <fielset>
                        <input type="text" name = 'nombre' placeholder="Nombre" value="{{$s->nombre}}"  class = "form-control " onblur="this.value=this.value.toUpperCase()"  required><br>
                        <input type="text" name = 'apellido' placeholder="Apellido" value="{{$s->apellido}}" class = "form-control" onblur="this.value=this.value.toUpperCase()"  required><br>
                        @if($s->grado == 'MAESTRO' or $s->grado == 'PASTMASTER')
                        <select name="cargo" class = "form-control"  required>
                            <option disabled selected>Puesto en Logia</option>
                            <option value="{{$s->cargo}}" selected>{{$s->cargo}}</option>
                            <option value="SIN CARGO">Sin Cargo</option>
                            <option value="VENERABLE MAESTRO">Venerable Maestro</option>
                            <option value="PRIMER VIGILANTE">Primer Vigilante</option>
                            <option value="SEGUNDO VIGILANTE">Segundo Vigilante</option>
                            <option value="ORADOR">Orador</option>
                            <option value="TESORERO">Tesorero</option>
                            <option value="SECRETARIO">Secretario</option>
                            <option value="MTO DE CEREMONIAS">Maestro de Ceremonias</option>
                            <option value="HOSPITALARIO">Hodpitalario</option>
                            <option value="PRIMER EXPERTO">Primer Experto</option>
                            <option value="SEGUNDO EXPERTO">Segundo Experto</option>
                            <option value="GURDATEMPLO">Guardatemplo Interior</option>
                            <option value="PRIMER DIACONO">Primer Diacono</option>
                            <option value="SEGUNDO DIACONO">Segundo Diacono</option>
                            <option value="TERRIBLE">Hermano Terrible</option>
                            <option value="HERMANO DE BANQUETES">Hermano de Banquetes</option>
                            <option value="MTO DE ARMONIA">Maestro de Armonia</option>
                        </select><br>
                       @endif
                        <select name="grado" class = "form-control" required>
                            <option disabled selected>Grado</option>
                            <option value="{{$s->grado}}" selected>{{$s->grado}}</option>
                            <option value="APRENDIZ">Aprendiz</option>
                            <option value="COMPANERO">Compañero</option>
                            <option value="MAESTRO">Maestro</option>
                            <option value="PAST MASTER">Past Master</option>
                        </select><br>
                        <select name="mlibre" class = "form-control" required>
                            <option disabled selected>Miembro Libre</option>
                            <option value="{{$s->mlibre}}" selected>{{$s->mlibre}}</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select><br>
                        <select name="voto" class = "form-control" required>
                            <option disabled selected>Estatus en la MRGL</option>
                            <option value="{{$s->voto}}" selected>{{$s->voto}}</option>
                            <option value="NO MIEMBRO">No miembro</option>
                            <option value="TRANSITORIO">Transitorio</option>
                            <option value="VOZ NO VOTO">Voz no voto</option>
                            <option value="PERMANENTE">Permanente</option>
                        </select><br>
                        <?php $l =  portalLogia\Taller::lists('nombreTaller', 'id')->toArray(); ?>
                        <select name="taller" class = "form-control" >
                            <option value = {{$s->id_taller}} selected>{{$s->nombreTaller}}</option>
                            @foreach($talleres as $t)
                            <option value="{{$t->id}}">{{$t->nombreTaller}}</option>
                            @endforeach
                        </select><br>

                        <select name="estado" class = "form-control" required>
                            <option disabled selected>Estatus Actual</option>
                            <option value="{{$s->estado}}" selected>{{$s->estado}}</option>
                            <option value="ACTIVO   ">Activo</option>
                            <option value="BAJA">Baja</option>
                            <option value="RADIADO">Radiado</option>
                        </select><br>
                        <input type="email"   name = 'email' placeholder = "Correo Electrónico" class =  "form-control" value = "{{$s->email}}"><br>
                        <input type=tel  id="telefono" name = 'telefono' placeholder="Telefono" value="{{$s->telefono}}" class = "form-control"><br>
                        <input type=tel  id="telefonoCel" name = 'telefonoCel' placeholder="Telefono de Casa" value="{{$s->telefonoCel}}" class = "form-control"><br>
                    </fielset>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-success "  > Guardar</button>
                    <button type="button" class="btn btn-default "  data-dismiss="modal" > Cerrar</button>

                </div>
                {!!Form::close()!!}


            </div>
        </div>
    </div>
@endforeach

@endsection

@section('scripts')

<!--desaparecer alertas -->

<script type="text/javascript">
  $(document).ready(function() {
      setTimeout(function() {
          $(".alert-success").fadeOut(1500);
      },3000);
  $("#telefono").mask("999-999-99-99");
  $("#telefonoCel").mask("999-999-99-99-99");



  });


</script>


@stop 