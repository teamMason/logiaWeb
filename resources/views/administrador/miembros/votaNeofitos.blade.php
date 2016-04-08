@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div><label>Avance de las votaciones de los neófitos. </label></div>
                </div>
                <div class="panel-body">
                    @include('includes.succes')
                    <div class="container" id="admin">
                        @foreach($solicitudes as $s)
                            <div class="row">
                                <div class="panel panel-default divSolicitudes">
                                    <div class="panel-body">
                                        <div class="col-sm-3 col-md-3">
                                            <strong> {{$s -> nombre}} {{$s -> apellido}} </strong><br>
                                            {{$s -> nombreTaller}}
                                            {{$s -> ciudad}}
                                        </div>
                                        @if(Auth::user()->stateSolicitud($s->id))
                                            <div class="col-sm-2 col-md-2 ">
                                                <span><i class="fa fa-check" style="color: green;"></i> Solicitus aprobada </span>
                                            </div>
                                        @endif
                                        @if(Auth::user()->stateVotacion($s->id))
                                            <li class="aprobado"><p><strong> Votacion Finalizada <i class="fa fa-check"></i></strong></p></li>
                                        @else
                                            <div class="col-sm-2 col-md-2">
                                                <a href="/verVotacion/{{$s->id}}" class="btn btn-default">VerVotación<i class="fa fa-eye"></i></a>
                                            </div>
                                        @endif
                                        @if(Auth::user()->stateVotacion($s->id))
                                            <div class=" col-sm-2 col-md-2">
                                                <span class="aprobado"><p><strong> Iniciación Concluida <i
                                                                    class="fa fa-check"></i></strong></p></span>
                                            </div>
                                            <div class="col-sm-2 col-md-2">
                                                <a href="/verVotacion/{{$s->id}}/{{$s->id_taller}}"
                                                   class="btn btn-success"><strong> Aceptar Miembro</strong></a>
                                            </div>
                                        @else
                                            <div class="col-sm-2 col-md-2">
                                                <span><p><strong> Esperando  iniciación</strong></p></span>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <a class="btn btn-success disabled"> <strong> Aceptar
                                                        Miembro</strong></a>
                                            </div>
                                        @endif
                                        <span class="trash">
                                            <a href="#my_modal" data-toggle="modal" data-book-id="{{$s -> id}}"
                                               class="btn btn-default" title="Borrar Solicitud"><i
                                                        class="fa fa-trash fa-2x"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!--Modal Borrar Solicitud-->
    <div class="modal fade" id="my_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Estas seguro de Borrar la Solicitud</h4>
                </div>
                {!! Form::open(array('url' => 'admin/verVotacion')) !!}
                <div class="modal-body">
                    <p>Una vez borrado perderás toda la información! </p>
                    <div>
                        <i class="fa fa-frown-o fa-5x"></i>
                    </div>
                    <input type="hidden" name="borrarId" value=""/>
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

            <!--desaparecer alertas -->

    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert-success").fadeOut(1500);
            }, 3000);
        });

        $('#my_modal').on('show.bs.modal', function (e) {
            var borrarId = $(e.relatedTarget).data('book-id');
            $(e.currentTarget).find('input[name="borrarId"]').val(borrarId);
        });

    </script>







@stop 

