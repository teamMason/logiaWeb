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
                <div class="panel-body ">
                    <div class="container" id="admin">
                        <div class="row">
                            {!!Form::model(Request::only(['typeBusqueda']),['method' => 'GET', null, 'method' => 'GET', 'class' => 'navbar-form text-right', 'id' => 'search-form'])!!}
                                @if(Auth::user()->isCompanero())
                                    <div class="form-group">
                                        {!! Form::select('typeBusqueda', ['Todos los grados','Aprendiz','Companero'], Input::old('typeBusqueda'), array('class' => 'form-control', 'id' => 'buscador')) !!}
                                    </div>
                                @elseif(Auth::user()->isAprendiz())
                                    <div class="form-group">
                                        {!! Form::select('typeBusqueda', ['Todos los grados','Aprendiz'], Input::old('typeBusqueda'), array('class' => 'form-control', 'id' => 'buscador')) !!}
                                    </div>
                                @else
                                    <div class="form-group">
                                        {!! Form::select('typeBusqueda', ['Todos los grados','Aprendiz','Companero', 'Maestro'], Input::old('typeBusqueda'), array('class' => 'form-control', 'id' => 'buscador')) !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {!! Form::text('busquedaTipeada',Input::old('busquedaTipeada'), array('class' => 'form-control', 'id' => 'buscador-tipeado')) !!}
                                </div>
                            <button type="submit" class="btn btn-info">Buscar</button>
                            {!!Form::close()!!}


                            <div id="resultados">
                            </div>

                        </div>

                        <hr>
                        <div class="row" id="libritos">
                            @foreach($libros as $l)
                                @if($l->editado == 'true' )
                                    <div class="col-xs-12 col-sm-3 ">
                                        <div class="thumbnail text-center libros" >

                                            <a href="../../../uploads/{{$l->slug}}" target="_blank" title="{{$l->titulo}}"><i class="fa fa-book fa-5x"></i></a>
                                            <div class="caption">
                                                <p></p><strong>{{ str_limit($l->autor,15,' ') }}</strong></p>
                                                <p><em>{{ str_limit($l->titulo,25,' ') }}</em></p>
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
@endsection
@section('scripts')
    <script src="{{ URL::to('assets/js/busquedaAjax.js') }}"></script>

@stop