<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
      -->
    <title>factura</title>
    <!-- {!! Html::style('assets/css/pdf.css') !!}
    <link rel="stylesheet" type="text/css" href="assets/css/pdf.css"> -->
  </head>
  <body>
        <main>

            <div style="text-align: center"><h1>Factura Mensual</h1></div>
            
            <div style="text-align: center"> <h2>Gran logía de Baja Californía</h2> <div style="text-align: right"> Fecha: {{ $fecha }}</div></div>
            <div style="text-align: center"><h3>{{ $extras['nombre_taller'] }}</h3></div>
            
            <div style="padding-left:20%;">
              <table cellspacing="1" cellpadding="5" >
                
                <thead style="text-align:center">
                <!-- Generar columnas -->
                  <tr>
                    <th class="Cantidad">Cantidad</th>
                    <th class="NombreRubro">Nombre</th>
                    <th class="P. Unitario">P. Unitario</th>
                    <th class="Monto">Monto</th>
                    
                     
                  </tr>
                </thead>

                <tbody >
                  <tr>
                    <td class="Cantidad">{{ $extras['capitas_pagar'] }}</td>
                    <td class="NombreRubro">Capitas</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->capitas}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['capitas'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_iniciaciones }}</td>
                    <td class="NombreRubro">Iniciaciones</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->iniciaciones}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['iniciaciones'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_regularizaciones }}</td>
                    <td class="NombreRubro">Regularizaciones</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->regularizaciones}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['regularizaciones'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_afiliaciones_com }}</td>
                    <td class="NombreRubro">Afiliaciones comunes</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->afiliaciones_com}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['afiliaciones_com'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_afiliaciones_priv }}</td>
                    <td class="NombreRubro">Afiliaciones privilegiadas</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->afiliaciones_priv}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['afiliaciones_priv'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_dispensa_tramite }}</td>
                    <td class="NombreRubro">Dispensa de tramites</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->dispensa_tramite}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['dispensa_tramite'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_derechos_exalt }}</td>
                    <td class="NombreRubro">Derechos de exaltacion</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->derechos_exalt}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['derechos_exalt'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_credencial }}</td>
                    <td class="NombreRubro">Credencial</td>
                    <td class="P.Unitario" style="text-align: right"> {{$rubros->credencial}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['credencial'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_diplomas }}</td>
                    <td class="NombreRubro">Diplomas</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->diplomas}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['diplomas'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_liturgia_a }}</td>
                    <td class="NombreRubro">liturgia A</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->liturgia_a}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['liturgia_a'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_liturgia_c }}</td>
                    <td class="NombreRubro">liturgia C</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->liturgia_c}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['liturgia_c'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_liturgia_m }}</td>
                    <td class="NombreRubro">liturgia M</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->liturgia_m}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['liturgia_m'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_status }}</td>
                    <td class="NombreRubro">Estatutos</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->status}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['status'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_constitucion }}</td>
                    <td class="NombreRubro">Constitucion</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->constitucion}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['constitucion'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_codigos_penales }}</td>
                    <td class="NombreRubro">Codigos Penales</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->codigos_penales}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['codigos_penales'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_activacion_logias }}</td>
                    <td class="NombreRubro">Activación</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->activacion_logias}}.00</td>
                    <td class="Monto" style="text-align: right">{{  $montos['act_logias'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $datos[0]->cant_aumento_sal }}</td>
                    <td class="NombreRubro">Aumento de salario</td>
                    <td class="P.Unitario" style="text-align: right">{{$rubros->aumento_sal}}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['aumento_sal'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad"> 1 </td>
                    <td class="NombreRubro">otros conceptos</td>
                    <td class="P.Unitario"></td>
                    <td class="Monto" style="text-align: right">{{ $montos['otros'] }}.00</td>
                  </tr>
                  <tr>
                    <td class="Cantidad">{{ $extras['m_totales'] }}</td>
                    <td class="NombreRubro">cuota extraordinaría</td>
                    <td class="P.Unitario" style="text-align: right">{{ $rubros->cuota_ext }}.00</td>
                    <td class="Monto" style="text-align: right">{{ $montos['cuota_ext'] }}.00</td>
                  </tr>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td >Adeudo anterior</td>
                    <td style="text-align: right">{{ $datos[0]->adeudo }}.00</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td >TOTAL</td>
                    <td style="text-align: right">{{ $montos['total'] }}.00</td>
                  </tr>
            
                </tfoot>
              </table>  
            </div>
        </main>
      
      <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> -->
  </body>
</html>