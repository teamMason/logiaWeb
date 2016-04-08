@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Factura del Mes</strong>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">

                            <div class="col-md-4 col-sm-4"></div>
                            <div class="col-md-4 col-sm-4">
                                <div class="panel panel-info libros">
                                    <div class="panel-body">

                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <i class="fa fa-money fa-3x"></i>
                                            </li>
                                        </ul>
                                        <div class="pull-right">
                                            <a href="{{asset('/pdf/'.$nombre.'.pdf')}}" target="_blank"
                                               class="btn btn-success">{{$nombre}}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-4"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@stop
