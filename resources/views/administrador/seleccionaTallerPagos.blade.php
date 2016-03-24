@extends('administrador.app')
@section('content')

    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Hacer Pagos</strong>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            {!! Form::open(array('url' => '/administrador/mostrarRecibo')) !!}
                            <div class="form-group">
                                <label for="talleres">Taller:</label>
                                <select name="talleres" id="idtaller" class="form-control">
                                    <option selected disabled>Seleccionar Taller</option>
                                    @foreach($talleres as $taller)
                                        <option class="form-control" value = "{{$taller->id}}">{{$taller->nombreTaller}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit"  class="btn btn-info pull-right"><i class="fa fa-money"></i>  Hacer Pagos</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop




















