@extends('administrador.app')

@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Registro de Administrativos</strong></div>
                    <div class="panel-body">
                        @include('includes.errors')
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('altaAdministrativa')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name Completo</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Taller</label>
                                <div class="col-md-6">
                                    {!! Form::select('role',[''=> 'Puesto','secretario'=>'Secretario','tesorero'=>'Tesorero'],old('role'), array('class' => 'form-control')) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Oriente de</label>
                                <div class="col-md-6">
                                    {!! Form::select('ciudad',['' => 'Seleccione un Oriente','Ensenada' => 'Ensenada','Mexicali' => 'Mexicali','Tecate'=>'Tecate','Tijuana' =>'Tijuana'] , old('ciudad'), array('class' => 'form-control')) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirmación de Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            @include('includes.succes')
            <table class="table table-striped table-hover ">
                <thead>
                <th>Nombre y Apellido</th>

                <th class="hidden-sm hidden-xs">Fecha de alta</th>
                <th>Acciones</th>
                </thead>
                <tbody>
                @foreach($administrativos as $s)
                    <tr>
                        <td>{{$s -> name}}</td>
                        <td class="hidden-sm hidden-xs">{{$s -> created_at}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="../../admin/confirmacion/borrar/{{$s->id}}">Borrar</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection