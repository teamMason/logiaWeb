@extends('administrador.app')
@section('content')
    <link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet">
    <div class="container-fluid">
        <span class="btn btn-info backVotos" onClick="history.back()"><i class="fa fa-chevron-left fa-3x"></i></span>
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                <span style="margin-right: 5%;">
              		<strong>Comentarios y votos de {{$solicitante->nombre}} {{$solicitante->apellido}}
                        de {{$solicitante->ciudad}}, ¿Aprobar Iniciación?</strong>
                </span> 
                <span class="text-right">
                	<a href="../verVotacion/aprobarIniciacion/{{$solicitante->id}}" class="btn btn-info"> Aprobar</a>
                </span>
                </div>
                <div class="panel-body">
                    @include('includes.errors')
                    @include('includes.succes')
                    <div class="container" id="admin">
                        <table class="table table-striped table-hover " action="javascript:alert('Submitted')">
                            <thead>
                            <th>Nombre del Taller</th>
                            <th>Comentarios</th>
                            <th>¿Conocido?</th>
                            </thead>
                            <tbody>
                            @foreach($votos as $v)
                                <tr>
                                    <td>{{$v -> nombreTaller}}</td>
                                    <td>{{$v -> comentarios}}</td>
                                    @if($v->estatus == 'desconocido')
                                        <td><i class="fa fa-times fa-3x" style="color: red;"></i></td>
                                    @else
                                        <td><i class="fa fa-check fa-3x" style="color: green;"></i></td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>



@stop	
