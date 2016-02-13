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
       
          <h1>Generar Factura Mensual </h1>
          
      </div> 
      <div style="text-align:center"> Gran logia de Baja California </div>
      <div style="text-align:center">
          {!! Form::open(array('url' => '/PDF/create')) !!}
            Taller:  
            <select name="talleres" id="idtaller" method="post">
            <option class="form-control" value = "-1">-Selecciona Taller</option>
              @foreach($talleres as $taller)
                <option class="form-control" value = "{{$taller->id}}">{{$taller->nombreTaller}}</option>
              @endforeach
            </select>
            Fecha:
            <select name="fechas" id="idfecha" method="post">
            <option class="form-control" value = "-2">-Selecciona fecha</option>
              @foreach($fechas as $fecha)
                <option class="form-control" value = "{{$fecha->fecha}}">{{$fecha->fecha}}</option>
              @endforeach
            </select>
            <br><br>
          <input type="submit"  class="btn btn-default" value="Generar Factura" style="text-align:center"></input>
          {!! Form::close() !!}          

      </div>
      
  </body>
</html>