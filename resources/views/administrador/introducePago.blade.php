@extends('administrador.app')
@section('content') 

<div style="text-align: center"><h3>Introduce pago</h3><br> <h2>{{$name['nombreTaller']}}</h2></div>
<div >
	{{--*/ $cont = 0 /*--}}
	
		{!! Form::open(array('action' => array('listaIntroducePagoController@recibePago', $id))) !!}
		Selecciona la fecha que deceas pagar:
		<select name="fecha" id="fecha" method="post">
        <option class="form-control" value = "-1">-</option>
          @foreach($fechas as $fecha)
            <option class="form-control" indice = {{ $cont }} value = {{ $fecha->fecha }}>{{$fecha->fecha}}</option>
            {{ $cont = $cont + 1 }}
          @endforeach
    	</select>
		<br><br>

		El adeudo del mes seleccionado es:
		<select name="adeudo" id="adeudo" method="post">
        <option class="form-control" value = "-1">-</option>
        @foreach($adeudos as $adeudo)
            <option class="form-control" value = {{ $adeudo->adeudo }}>{{$adeudo->adeudo}}</option>
        @endforeach
    	</select>
		<br><br>

	<input type="submit" class="btn btn-default" value="Pagar" ></input><br><br>
	
</div>

<script type="text/javascript" src="{!! asset('assets/js/jquery.js') !!}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		adeudos = <?php echo json_encode($adeudos) ?>;// obtener variable de php
		$("#fecha").change(function() {
			$("#adeudo").find('.form-control').remove(); //buscar clase y eliminar del select
			//var index = $(this).atrr('indice');
			var index = jQuery("#fecha").attr("indice");
			console.log(index);
			var html = '<option  class="form-control" value ="'+ adeudos[index]["adeudo"]  +'">' + adeudos[index]["adeudo"] + '</option>';
			$("#adeudo").append(html);
			//console.log(adeudos[index]["adeudo"]);
		});
	});
</script>
{!! Form::close() !!}  
@endsection	

