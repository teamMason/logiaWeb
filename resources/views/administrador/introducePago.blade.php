@extends('administrador.app')
@section('content')

<<<<<<< HEAD
    <div style="text-align: center"><h3>Introduce pago</h3><br>
        <h2>{{$name['nombreTaller']}}</h2></div>
    <div>
        {{--*/ $cont = 0 /*--}}

        {!! Form::open(array('action' => array('listaIntroducePagoController@recibePago', $id))) !!}
        Selecciona la fecha que deceas pagar:
        <select id="fecha" name="fecha" method="post">
            <option class="form-control" indice=-1 value="-1">-</option>
            @foreach($fechas as $fecha)
                <option class="form-control" indice={{ $cont }}  value = {{ $fecha->fecha }}>{{$fecha->fecha}}</option>
                {{ $cont = $cont + 1 }}
            @endforeach
        </select>
        <br><br>
=======
<div style="text-align: center"><h3>Introduce pago</h3><br> <h2>{{$name['nombreTaller']}}</h2></div>
<div >
	{{--*/ $cont = 0 /*--}}
	
		{!! Form::open(array('action' => array('listaIntroducePagoController@recibePago', $id))) !!}
		Selecciona la fecha que deceas pagar:
		<select id="fecha" name = "fecha" method="post">
        <option  class="form-control" indice = -1 value = "-1">-</option>
          @foreach($fechas as $fecha)
            <option class="form-control" indice = {{ $cont }}  value = {{ $fecha->fecha}} > {{$fecha->fecha}}</option>
            {{ $cont = $cont + 1 }}
          @endforeach
    	</select>
		<br><br>
		
		El adeudo del mes seleccionado es:
		<select name="adeudo" id="adeudo" method="post">
        	<!-- <option class="form-control" value = "-1">-</option> -->
    	</select>
		<br><br>
		Introduce el pago o abono a realizar:
		<input type="text" class="pago" id="pago" name="pago" ></input><br><br>
		<input type="submit" class="btn btn-default" value="Pagar" ></input><br><br>
</div>
>>>>>>> 8d22886ba742906d7dabef0470ecf58ee253554a

        El adeudo del mes seleccionado es:
        <select name="adeudo" id="adeudo" method="post">
            <!-- <option class="form-control" value = "-1">-</option> -->
        </select>
        <br><br>

        <input type="submit" class="btn btn-default" value="Pagar"></input><br><br>

    </div>

@endsection
@section("scripts")
<script>
    $(document).ready(function () {
        $adeudos = <?php echo json_encode($adeudos) ?>;// obtener variable de php
        $("#fecha").change(function () {
            /* obtener el atributo indice de la opcion selecccionada
<<<<<<< HEAD
             en el select con el $id fecha */
            var index = $('option:selected', this).attr('indice')
            if (index < 0) {
                alert("seleccione una fecha")
                $("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
            }
            else {
                $("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
                var html = '<option  class="form-control" value ="' + adeudos[index]["adeudo"] + '">' + adeudos[index]["adeudo"] + '</option>';
                $("#adeudo").append(html); // colocamos la variable dentro del select adeudo
            }
        });
    });
=======
            en el select con el $id fecha */
        	var index = $('option:selected',this).attr('indice')
     		if(index < 0){
     			$("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
     			alert("seleccione una fecha")
     		}
     		else{
           		$("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
				var html = '<option  class="form-control" value ="'+ adeudos[index]["adeudo"]  +'">' + adeudos[index]["adeudo"] + '</option>';
				//console.log(adeudos[index]);
				$("#adeudo").append(html); // colocamos la variable dentro del select adeudo
			}
		});
	});
	$(document).ready(function() {
		$("#pago").change(function() {
        	var pago = $("#pago").val();
        	var adeudo = $("#adeudo").val()
     		if(pago > adeudo){
     			$("#pago").val(0); //remover el pago
     			alert("No debe pagar mas de lo que debe")
     		}
     		if(pago < 0){
     			$("#pago").val(0); //remover el pago
     			alert("se puede pagar cantidades negativas")
     		}
		});
	});
>>>>>>> 8d22886ba742906d7dabef0470ecf58ee253554a
</script>
{!! Form::close() !!}
@endsection

