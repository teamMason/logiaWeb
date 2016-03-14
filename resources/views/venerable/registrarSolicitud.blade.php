@extends('administrador.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div><label>Cedula de solicitud de nuevos Neófito</label></div>
                </div>
                <div class="panel-body">

                    @include('includes.errors')
                    @include('includes.succes')
                    <div class="container" id="admin">
                        <link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet">
                        <div class="row-flui">
                            <div class="container">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    {!! Form::model(Request::only(['edoCivil','path']),array('url' => '/miembros/solicitud',  'enctype' => 'multipart/form-data')) !!}
                                    <fielset><br>
                                        <input type="text" name='nombre' placeholder="Nombre"
                                               value="{{Input::old('nombre')}}" class="form-control "
                                               onblur="this.value=this.value.toUpperCase()" required><br>
                                        <input type="text" name='apellido' placeholder="Apellido"
                                               value="{{Input::old('apellido')}}" class="form-control"
                                               onblur="this.value=this.value.toUpperCase()" required><br>

                                        <select name="id_taller" class="form-control">
                                            @foreach($taller as $s)
                                                <option value="{{$s->id_taller}}"
                                                        selected="selected">{{$s->nombreTaller}}</option>
                                            @endforeach
                                        </select><br>
                                        <select name="ciudad" class="form-control">
                                            @foreach($taller as $d)
                                                <option value="{{$d->ciudad}}"
                                                        selected="selected">{{$d->ciudad}}</option>
                                            @endforeach
                                        </select><br>
                                        <input type="text" name='profesion' placeholder="Profesión"
                                               value="{{Input::old('profesion')}}" class="form-control "
                                               onblur="this.value=this.value.toUpperCase()" required><br>
                                        <select name="edoCivil" value="{{Input::old('edoCivil')}}" class="form-control"
                                                size=5 required>
                                            <optgroup label="Estado Civil">
                                                <option value="Casado">Casado</option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Union libre">Unión libre</option>
                                                <option value="Viudo">Viudo</option>
                                                <option value="{{old('edoCivil')}}"
                                                        selected>{{old('edoCivil')}}</option>
                                            </optgroup>
                                        </select><br>
                                        <input type="text" id="dinero" name="ingresoMen" placeholder="Ingreso Mensual"
                                               class="form-control" value="{{Input::old('ingresoMen')}}" required><br>
                                        <input type="email" name='email' placeholder="Correo Electrónico"
                                               class="form-control" value="{{Input::old('email')}}"><br>
                                        <input type="text" id="telefonoCel" name='telefonoCel'
                                               placeholder="Teléfono Celular" class="form-control"
                                               value="{{Input::old('telefono')}}"><br>
                                        <input type="text" id="telefono" name='telefono'
                                               placeholder="Teléfono Adicional" class="form-control"
                                               value="{{Input::old('telefonoCel')}}"><br>
                                        {!!Form::file('file', ['class' => 'form-control', 'required' => 'required']) !!}
                                        <br>
                                        <textarea name="comentarios" id="" cols="30" rows="10" class="form-control"
                                                  placeholder="*Comentarios">{{ Input::old('comentarios') }}</textarea><br>
                                        <p>
                                            <input type="submit" value="Enviar Solicitud"
                                                   class="btn btn-block btn-success btn-lg">
                                        </p>


                                    </fielset>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#telefonoCel").mask("999-999-99-99");
            $("#telefono").mask("999-999-99-99-99");
            $('#dinero').mask('000.000.000.000.000,00', {reverse: true}, {'translation': {A: {pattern: /[A-Za-z0-9]/}}});
        });
    </script>
@stop
