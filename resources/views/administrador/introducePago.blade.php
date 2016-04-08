@extends('administrador.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            @include('includes.errors')
            @include('includes.succes')
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="container-fluid">
                        <strong>Registrar pago de {{$name['nombreTaller']}} </strong>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="container ">
                            {{--*/ $cont = 0 /*--}}
                            {!! Form::model(Request::only(['fecha', 'adeudo']),['action' => ['listaIntroducePagoController@recibePago', $id]]) !!}
                            <div class="form-group">
                                <label for="fecha">Seleciionar fecha:</label>
                                <select id="fecha" name="fecha" value="{{Input::old('fecha')}}"  class="form-control">
                                    <option indice=-1 value="-1" disabled selected> Seleccione una fecha</option>

                                    @foreach($fechas as $fecha)
                                        <option indice={{ $cont }}  value = {{ $fecha->fecha}}>
                                        {{$fecha->fecha}}</option>
                                        {{ $cont = $cont + 1 }}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="adeudo">Adeudo del mes: </label>
                                <select name="adeudo" id="adeudo" class="form-control">
                                    <!-- <option class="form-control" value = "-1">-</option> -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pago"> Introduce el pago:</label>
                                <input type="text" class="pago form-control" id="pago" name="pago">
                            </div>
                            <button type="submit" class="btn btn-info pull-right"> Pagar</button>


                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            adeudos = <?php echo json_encode($adeudos) ?>;// obtener variable de php
            $("#fecha").change(function () {
                /* obtener el atributo indice de la opcion selecccionada
                 en el select con el $id fecha */
                var index = $('option:selected', this).attr('indice')
                if (index < 0) {
                    $("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
                    alert("seleccione una fecha")
                }
                else {
                    $("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
                    var html = '<option  class="form-control" value ="' + adeudos[index]["adeudo"] + '">' + adeudos[index]["adeudo"] + '</option>';
                    //console.log(adeudos[index]);
                    $("#adeudo").append(html); // colocamos la variable dentro del select adeudo
                }
            });


            // $('#pago').mask('000.000.000.000.000,00', {reverse: true}, {'translation': {A: {pattern: /[A-Za-z0-9]/}}});

        });

    </script>
    {!! Form::close() !!}
@stop
