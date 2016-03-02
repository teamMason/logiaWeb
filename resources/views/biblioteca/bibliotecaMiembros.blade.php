@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Biblioteca Digital</strong>
                        <span>Te recordamos que solo puedes ver los libros de tu grado.</span>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            @foreach($libros as $l)
                                @if($l->editado == 'true' )
                                    <div class="col-xs-12 col-sm-4 ">
                                        <div class="thumbnail text-center libros" >

                                            <a href="../../../uploads/{{$l->slug}}" target="_blank" title="{{$l->titulo}}"><i class="fa fa-book fa-5x"></i></a>
                                            <div class="caption">
                                                <h5 style="text-transform: uppercase"><strong>{{ str_limit($l->titulo,15,' ') }}</strong></h5>
                                                <p><h4>Autor: {{$l->editado}}</h4></p>
                                                <p>Grado {{$l->grado}}</p>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="text-center">
                                {!! $libros->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop