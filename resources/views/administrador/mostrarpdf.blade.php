@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Facturas de los diferentes talleres</strong>
                        <span class="pull-right">
                            <a data-toggle="modal" title="Ver información" data-target="#info-pdfs"  class="btn btn-info">Crear Facturas del nuevo mes</a>
                         </span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            @foreach($nom as $n)
                                <div class="list-group">
                                    <a href="{{asset('/pdf/'.$n.'.pdf')}}" target="_blank"
                                       class="list-group-item" title="{{$n}}}">{{ str_limit($n,30,' ') }}
                                        <span class="pull-right">  <i
                                                    class="fa fa-file-pdf-o fa-2x"></i></span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="info-pdfs" class="modal fade modal " role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <strong>Crear facturas del nuevo mes</strong>
                </div>
                <div class="container-fluid">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="alert alert-warning">
                                    <p>
                                        Una vez presiones el boton de crear se borran las facturas del mes actual y se crearan
                                        las del mes siguiente, consulta con el administrador si tienes dudas.
                                    </p>
                                </div>
                                <div id="work" class="hidden">
                                    <i class="fa fa-cog fa-spin"></i> Trabajando ....
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">

                    <button type="button" class="btn btn-default " data-dismiss="modal"> Cerrar</button>
                    <a href="/PDF/downloadAll/" class="btn btn-success" onclick="ocultar();"> Crear</a>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function ocultar()
        {
            $( '#work' ).removeClass( "hidden" );
        }
    </script>


@stop

