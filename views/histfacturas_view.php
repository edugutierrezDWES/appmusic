<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Historial Facturas</title>
    </head>
    <body>
	 <p><h1>Facturas</h1></p>
        <table border="1">
            <tr>
                <th>Factura ID</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        <?php
        foreach ($facturas as $factura) {
            echo "<tr>
                <td>". $factura["InvoiceId"] ."</td>
                <td>". $factura["InvoiceDate"] ."</td>
                <td>". $factura["Total"] ." €</td>
             </tr>";
        }
              
        ?>
      </table>
    </body>
</html>
