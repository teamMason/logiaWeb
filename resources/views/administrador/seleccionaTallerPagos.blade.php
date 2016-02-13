<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     @include('includes.head') 
    <title>Selecciona taller</title>
    
   <!-- <link rel="stylesheet" type="text/css" href="assets/css/pdf.css"> -->
  </head>
  <body>

    <main>
      <div style="text-align:center">
       
          <h1> </h1>
          
      </div>
      <div style="text-align:center"> Gran logia de Baja California </div>
      <div style="text-align:center">
          {!! Form::open(array('url' => '/administrador/mostrarRecibo')) !!}
            Taller:   
            <select name="talleres" id="idtaller" method="post">
            <option class="form-control" value = "-1">-</option>
              @foreach($talleres as $taller)
                <option class="form-control" value = "{{$taller->id}}">{{$taller->nombreTaller}}</option>
              @endforeach
            </select>
            
            <br><br>
          <input type="submit"  class="btn btn-default" value="Ir a pagar" style="text-align:center"></input>
          {!! Form::close() !!}          

      </div>
      
  </body>
</html>