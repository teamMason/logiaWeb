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

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            @foreach($nom as $n)
                                <div class="list-group">
                                    <a href="{{asset('/pdf/'.$n.'.pdf')}}" target="_blank"
                                       class="list-group-item">{{ str_limit($n,25,' ') }}
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


@stop

