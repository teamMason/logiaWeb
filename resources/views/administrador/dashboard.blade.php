@extends('administrador.app')
@section('content') 
<h1>Graficas</h1>

<div id="container" style="width:100%; height:400px;"></div>
<!-- script type="text/javascript" src="{{ asset('js/highcharts.js') }}"></script -->

@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('#container').highcharts(
            {!! json_encode($yourFirstChart); !!}
        );
    })

$(document).ready(function () { 
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Fruit Consumption'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
        }]
    });
});
</script>
@stop