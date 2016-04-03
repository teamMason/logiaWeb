@extends('administrador.app')
@section('content')
 
<div class="container-fluid"> 
  <div class="row-fluid">
    <div class="panel panel-default">
        <div class="panel-heading ">               
          <div ><label >Solicitudes de ingreso  </label></div>          
        </div>
        <div class="panel-body">
           @include('includes.succes')          
          <div class="container" id="admin">
            <table class = "table table-striped table-hover " action="javascript:alert('Submitted')" >
              <thead>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
                       
                         
              </thead>
              <tbody>
                @foreach($iniciaciones as $s)
                <tr>
                  <td>{{$s -> nombre}}</td>
                  <td>{{$s -> apellido}}</td>                                              
                  <td>
                    <div class="">              
                        @if($s->estadoVotacion == 'true' )  
                          <a href="../admin/iniciaciones/{{$s->id}}" class="btn btn-success">Iniciación Concluida</a>            
                                                                  
                        @else
                          <button class="btn btn-success disabled">En Proceso...</button>
                        
                        @endif
                    </div>
                  </td>                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        
        </div>
    </div>
  </div>
   
</div>

@stop