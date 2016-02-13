@extends('administrador.app')
@section('content') 
<div style="text-align: center"><h3>Montos por Taller</h3></div>
<div style="text-align: center">
	<table style="width:25%">
		
		<tbody>
			@foreach($recibos as $recibo)
			<tr>
				<th>Capitas</th>
				<td>{{ $recibo['monto_capitas'].00 }}</td>
			</tr>
			<tr>
				<th>Iniciaciones</th>
				<td>{{ $recibo['monto_iniciaciones'].00 }}</td>
			</tr>
			
			<tr>
				<th>Regularizaciones</th>
				<td>{{ $recibo['monto_regularizaciones'].00 }}</td>
			</tr>
			<tr>
				<th>Afiliaciones Comunes</th>
				<td>{{ $recibo['monto_afiliaciones_com'].00 }}</td>
			</tr>
			<tr>
				<th>Afiliaciones Privadas</th>
				<td>{{ $recibo['monto_afiliaciones_priv'].00 }}</td>
			</tr>
			<tr>
				<th>Dispensa de Tramite</th>
				<td>{{ $recibo['monto_dispensa_tramite'].00 }}</td>
			</tr>
			<tr>
				<th>Derechos Exaltacion</th>
				<td>{{ $recibo['monto_derechos_exalt'].00 }}</td>
			</tr>
			<tr>
				<th>Credencial</th>
				<td>{{ $recibo['monto_credencial'].00 }}</td>
			</tr>
			<tr>
				<th>Diplomas</th>
				<td>{{ $recibo['monto_diplomas'].00 }}</td>
			</tr>
			<tr>
				<th>Liturgia C</th>
				<td>{{ $recibo['monto_liturgia_a'].00 }}</td>
			</tr>
			<tr>
				<th>Liturgia C</th>
				<td>{{ $recibo['monto_liturgia_c'].00 }}</td>
			</tr>
			<tr>
				<th>Liturgia M</th>
				<td>{{ $recibo['monto_liturgia_m'].00 }}</td>
			</tr>
			<tr>
				<th>Estatutos</th>
				<td>{{ $recibo['monto_status'].00 }}</td>
			</tr>
			<tr>
				<th>Contitucion</th>
				<td>{{ $recibo['monto_constitucion'].00 }}</td>
			</tr>
			<tr>
				<th>Codigos Penales</th>
				<td>{{ $recibo['monto_codigos_penales'].00}}</td>
			</tr>
			<tr>
				<th>Aumento Salario</th>
				<td>{{ $recibo['monto_aumento_sal'].00 }}</td>
			</tr>
			<tr>
				<th>Otros Conceptos</th>
				<td>{{ $recibo['otros_conceptos'].00 }}</td>
			</tr>
			<tr>
				<th>Cuota Extra</th>
				<td>{{ $recibo['cuota_extra'].00 }}</td>
			</tr>
			<tr>
				<th>Pago</th>
				<td>{{ $recibo['pago'].00 }}</td>
			</tr>
			<tr>
				<th>Adeudo</th>
				<td>{{ $recibo['adeudo'].00 }}</td>
			</tr>
			<tr>
				<th>Total</th>
				<td>{{ $recibo['total'].00 }}</td>
			</tr>
			<tr>
				<th>Fecha</th>
				<td>{{ $recibo['fecha'] }}</td>
			</tr>
			<br><br>
			@endforeach
		</tbody>

	</table>
</div>



@stop	