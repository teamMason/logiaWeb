@extends('administrador.app')
@section('content') 
<h1>Graficas</h1>

<div id="container" style="width:100%; height:400px;"></div>
<div id="containerGrado" style="width:100%; height:500px;"></div>
<div id="containerMGrado" style="width:100%; height:400px;"></div>
<div id="containerPasTrans" style="width:100%; height:400px;"></div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#container').highcharts(
            {!! json_encode($miembrosOriente); !!}
        );
    });

    $(function () {
        $('#containerGrado').highcharts(
            {!! json_encode($mGrado); !!}
        );
    });
   
   $(function () {
        $('#containerMGrado').highcharts(
            {!! json_encode($mOrienteGrado); !!}
        );
    })

   $(function () {
        $('#containerPasTrans').highcharts(
            {!! json_encode($pasTrans); !!}
        );
    })
</script>
@stop