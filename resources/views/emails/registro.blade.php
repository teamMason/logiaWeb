<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body style="font-size: 18px;">
<div>
    <div width="100%" style=" overflow: hidden; margin:0 ;min-height:100px; border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px; background:#E6E6FA ;">
        <h3 style="text-align: center;">Nuevo Resgitro de Venerable Maestro</h3>


    </div>
    <div width="100%"
         style=" overflow: hidden; margin:0;min-height:300px;border:1px solid #e0e0e0; padding: 20px; font-size: 18px;">


        <p>
            De parte del portal de la Muy Respetable Gran logia
            de Estado Baja California hacemos de su conocimiento
            que se ha registrado como Venerable Maestro el usuario <strong> {{$nombre}} </strong> de la ciudad
            de <strong>{{$ciudad}}</strong> para el taller: {{$taller->nombreTaller}} y espera confirmación de su parte.
        </p>

        <p>
            Para Confirmar por favor de click en el siguiente enlace o ingresando al portal en la sección de venerables
            maestro.
        </p>

        <p><a href="{{$url}}">{{$url}}</a></p>

        <p>
            Portal Masónico de la Muy Rsspetable Gran Logia de Estado
        </p>


    </div>
</div>
</body>
</html>