@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Facturas por Taller</strong>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            {!! Form::open(array('url' => '/PDF/create')) !!}
                                <div class="form-group">
                                    <label for="talleres">Taller</label>
                                    <select name="talleres" id="idtaller" class="form-control">
                                        <option selected>-Selecciona Taller</option>
                                        @foreach($talleres as $taller)
                                            <option
                                                    value="{{$taller->id}}">{{$taller->nombreTaller}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechas">Fecha</label>
                                    <select name="fechas" id="idfecha" class="form-control">
                                        <option selected>-Selecciona fecha</option>
                                        @foreach($fechas as $fecha)
                                            <option class="form-control"
                                                    value="{{$fecha->fecha}}">{{$fecha->fecha}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-file-pdf-o"></i> Generar Facturas </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
















