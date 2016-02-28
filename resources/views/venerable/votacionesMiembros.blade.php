@extends('administrador.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div><label>Solicitudes de ingreso </label></div>
                </div>
                <div class="panel-body">
                    @include('includes.succes')
                    <div class="container" id="admin">
                        <div class="row">
                            <table class="table table-striped table-hover " action="javascript:alert('Submitted')">
                                <thead>
                                <th>Nombre</th>
                                <th>Taller</th>
                                <th>Oriente de</th>
                                </thead>
                                <tbody>
                                @foreach($solicitudes as $s)
                                    <tr>
                                        <td>{{$s -> nombre}} {{$s -> apellido}}</td>
                                        <td>{{$s -> nombreTaller}}</td>
                                        <td>{{$s -> ciudad}}</td>
                                        <td>
                                            <div class="hidden-xs hidden-sm">
                                                <a class="btn btn-info" type="button" class="btn btn-info " data-toggle="modal" data-target="#info-{{$s->id}}">
                                                    <i class="fa fa-info"></i>
                                                </a>
                                                <a class="btn btn-success" type="button" data-toggle="modal" data-target="#votar-{{$s->id}}">
                                                    <i class="fa fa-check-square-o"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="hidden-md hidden-lg">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a type="button" data-toggle="modal" data-target="#info-{{$s->id}}">
                                                            Ver
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a type="button" data-toggle="modal" data-target="#votar-{{$s->id}}">
                                                            Votar
                                                        </a>
                                                    </li>

                                                </ul>
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
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4" align="center">
                                <th><img src="../assets/img/portfolio/Logo1.png" class="img-circle img-responsive"
                                         alt="" width="150" height="100"></th>
                            </div>
                            <div class="col-md-8 text-center">
                                <p>Muy Resp.·.Log.·. De Estado Baja California, AA.·.LL.·. y AA.·.MM.·.</p>
                                <p>Calla 9na No. 8169 ofna 302, zona Centro Gr.·.Or.·. de Tijuena, B.C. Tel:
                                    01-(646)-685-22-72</p>
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
                                            <li><strong class="hidden-xs">Estado Civil: </strong> {{$s->edoCivil}}</li>
                                            <li><strong class="hidden-xs">Ingreso Mensual: </strong> {{$s->ingresoMen}}
                                            </li>
                                            <li><strong class="hidden-xs">Teléfono: </strong> {{$s->telefono}}</li>
                                            <li><strong class="hidden-xs">Teléfono
                                                    Celular: </strong> {{$s->telefonoCel}}</li>
                                            <li><strong class="hidden-xs">Comentarios: </strong> {{$s->comentarios}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-4">
                                    <img src="../fotos_solicitud/{{$s->path}}" class="img-thumbnail img-responsive"
                                         alt="" width="150" height="100">
                                    <p>Votar antes del día: {{$s->fechaLim}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default " data-dismiss="modal"> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


                <!-- Modal Para Votar -->
        <div class="container">
            @foreach($solicitudes as $s)
                <div id="votar-{{$s->id}}" class="modal fade " role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Información de: {{$s->nombre}}</h4>
                            </div>
                            <div class="modal-body">
                                {!!  Form::open(array('action' => array('venerableController@enviarVotacion', $s->id, Auth::user()->id_taller )))  !!}
                                <h4>Estatus del Neófito:</h4>
                                <span><input type="radio" name="voto" value="conocido" checked> Conocido </span>
                                <span><input type="radio" name="voto" value="desconocido"> Desconocido </span><br>
                                <h4>Comentarios adicionales:</h4>
                            <textarea name="comentarios" class="form-control" rows="10" cols="50"
                                      placeholder></textarea>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-success" value="Enviar a Votación">
                            </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#hide").click(function () {
                $("#element").slideUp();
            });
            $("#show").click(function () {
                $("#element").slideDown();
            });
        });
    </script>
    @endsection
            <!--desaparecer alertas -->
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert-success").fadeOut(1500);
            }, 3000);
        });
    </script>
@endsection


@stop 

