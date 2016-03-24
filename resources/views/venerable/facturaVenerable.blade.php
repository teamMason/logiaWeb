@extends('administrador.app')
@section('content')

<a href="{{asset('/pdf/'.$nombre.'.pdf')}}" target="_blank">{{$nombre}}</a>  <br>
@stop