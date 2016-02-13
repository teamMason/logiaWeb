@extends('administrador.app')
@section('content') 

@foreach($nom as $n)
 
<a href="{{asset('/pdf/'.$n.'.pdf')}}" target="_blank">{{ $n }}</a>  <br>
@endforeach
@stop	