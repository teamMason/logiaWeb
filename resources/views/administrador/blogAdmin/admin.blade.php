@extends('administrador.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($_SERVER['REQUEST_URI'] == '/admin')
                @if (Auth::user()->isAdmin() or Auth::user()->isSecretario() or Auth::user()->isVenerable())
                    <div class="col-md-6">
                        <img src="../assets/img/portfolio/secretary.png" class="img-thumbnail img-responsive" alt=""
                             width="100%" height="100"> </th>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Notificaciones de Miembros</h3>
                            </div>
                            <div class="panel-body">
                                <ul style="list-style-type:none">
                                    <li>Actualmente se está votando por <strong style="color: red;"> {{$votaciones}} </strong> neofitos diferentes.</li>
                                    @if(Auth::user()->isAdmin() or Auth::user()->isSecretario())
                                        <li>Existen <strong style="color: red;"> {{$aprobaciones}} </strong> Solicitudes en espera de Aprobación:</li>
                                        <li >Tienes <strong style="color: red;"> {{$alta}} </strong> altas en padrón sin aprobar.</li>
                                        <li >Tienes <strong style="color: red;"> {{$buzon}} </strong> mensajes del buzón sin Leer.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            @endif
        </div>
    </div>


@stop	