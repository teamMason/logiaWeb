@extends('administrador.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <strong style="margin-right: 15px;"> Miembros registrados de los diferentes talleres.</strong>
                    <strong>Hay {{$venerables->total()}} Registros </strong>
                </div>
                <div class="panel-body">
                    @include('includes.succes')
                    @include('includes.errors')
                    <div class="container" id="admin">
                        <div class="row">
                            <div class="form-group ">
                                {!!Form::model(Request::only(['busqueda']),['method' => 'GET', null, 'method' => 'GET', 'class' => 'navbar-form text-right', 'id' => 'search-form'])!!}
                                <div class="form-group">
                                    {!! Form::text('busqueda',Input::old('busquedaTipeada'), array('class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Buscar</button>
                                </div>
                                {!!Form::close()!!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <table class="table table-striped table-hover ">
                                <thead>
                                <th>Nombre y Apellido</th>
                                <th>Taller</th>
                                <th class="hidden-sm hidden-xs">Fecha de alta</th>
                                <th class="hidden-sm hidden-xs">Estado</th>
                                <th>Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($venerables as $s)
                                    <tr>
                                        <td>{{$s -> name}}</td>
                                        <td>{{$s -> nombreTaller}}</td>
                                        <td class="hidden-sm hidden-xs">{{$s -> created_at}}</td>
                                        @if($s->token != null)
                                            <td class="alert-warning">Espera de aprobación</td>
                                        @else
                                            <td class="alert-success">Activo</td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @if($s->token !=  null)
                                                        <li>
                                                            <a href="../../admin/confirmacion/{{$s->token}}">Aceptar</a>

                                                        </li>
                                                        <li><a href="../../admin/confirmacion/rechazar/{{$s->id}}">Rechazar</a></li>
                                                    @else
                                                        <li><a href="../../admin/confirmacion/borrar/{{$s->id}}">Borrar</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
