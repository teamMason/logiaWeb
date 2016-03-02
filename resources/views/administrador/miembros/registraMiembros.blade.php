@extends('administrador.app')
@section('content')
<link href="{{ URL::asset('assets/css/trumbowyg.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="panel panel-default">
            <div class="panel-heading ">                          
                <div ><label >Cédula de registro, registrar miembro sin votación.</label></div>               
            </div>
            <div class="panel-body"> 
                    @include('includes.errors')
                    @include('includes.succes')
                    <div class="container" id="admin">
                            <div class="row-flui">                              
                                <div class="container">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">

                                        {!! Form::model(Request::all(),array('url' => '/miembros/crear/'))!!}
                                            <fielset>
                                                <input type="text" name = 'nombre' placeholder = "Nombre" class = "form-control" value ="{{Input::old('nombre')}}" onblur="this.value=this.value.toUpperCase()" required><br>
                                                <input type="text" name = 'apellido' placeholder = "Apellido" class = "form-control" value ="{{Input::old('apellido')}}" onblur="this.value=this.value.toUpperCase()" required><br>

                                                <select name="grado" class = "form-control" required>
                                                    <option disabled selected>Grado</option>
                                                    <option value="APRENDIZ">Aprendiz</option>
                                                    <option value="COMPANERO">Compañero</option>
                                                    <option value="MAESTRO">Maestro</option>
                                                    <option value="PAST MASTER">Past Master</option>
                                                </select><br>
                                                <select name="taller" class = "form-control" required>
                                                   <option >Taller</option> 
                                                @foreach($talleres as $t)
                                                   <option value="{{$t->id}}">{{$t->nombreTaller}}</option>                                                                                                       
                                                @endforeach              
                                                </select><br>
                                                <input type="email"   name = 'email' placeholder = "Correo Electrónico" class =  "form-control"><br>

                                                <input input type=tel id="telefono" name = 'telefono' placeholder = "Teléfono Fijo" class = "form-control"><br>
                                                <input input type=tel id="telefonoCel" name = 'telefonoCel' placeholder = "Teléfono Celular" class = "form-control"><br>
                                        
                                                <p>
                                                    <input type="submit" value="Registrar" class="btn btn-block btn-success btn-lg">
                                                </p>
                                                    
                                            </fielset>
                                        {!!Form::close()!!}

                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>                  
                    </div>                
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<!--desaparecer alertas -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#numero').mask('999-999-99-99');
      setTimeout(function() {
          $(".alert-success").fadeOut(2000);
      },3000);
      $("#telefono").mask("999-999-99-99");
      $("#telefonoCel").mask("999-999-99-99-99");
  });
</script> 


@stop	
