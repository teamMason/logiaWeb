@extends('administrador.app')
@section('content')



    <div class="row-fluid">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Grficas de Crecimiento</strong>
                </div>
                <div class="panel-body">
                    <div id="container" style="width:100%; height:400px;"></div>
                    <div id="containerGrado" style="width:100%; height:500px;"></div>
                    <div id="containerMGrado" style="width:100%; height:400px;"></div>
                    <div id="containerPasTrans" style="width:100%; height:400px;"></div>
                </div>
            </div>

        </div>
    </div>





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