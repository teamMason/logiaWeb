<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    
   <!-- <link rel="stylesheet" type="text/css" href="assets/css/pdf.css"> -->
  </head>
  <body>

    <main>
      <div id="details" class="clearfix" text-align:center>
        <div id="invoice" text-aling:center>
          <h1>Factura Mensual</h1>
          
          <div class="date" text-align="center"> <h3> Gran logía de Baja Californía </h3></div>
        </div>
      </div>
      <table border="1" cellspacing="1" cellpadding="1">
        <thead>
        <!-- Generar columnas -->
          <tr>
            <td class="Taller">Cantidad</td>
            <td class="Nombre">Nombre</td>
            <td class="Miembros">Miembros</td>
            <td class="capita">capita</td>
            <td class="total">Total</td>
          </tr>
        </thead>

       

        <tbody>
          <tr>
            <td class="cantidad">{{ $data['quantity'] }}</td>
            <td class="tipo">{{ $data['description'] }}</td>
            <td class="cuota">{{ $data['price'] }}</td>
            <td class="total">{{ $data['total'] }} </td>
          </tr>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="1"></td>
            <td >TOTAL</td>
            <td>$6,500.00</td>
          </tr>
        </tfoot>
      </table>
  </body>
</html>