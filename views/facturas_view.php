<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
</head>
<body>
<h1>Consulte sus facturas <span style="color: gray;"><?php echo $_SESSION["usuario"];?></span>  </h1>
<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
        <label for='fecha_inicio'>Fecha Inicio</label>
		<input type='date' name='fecha_inicio'><br>

		<label for='fecha_fin'>Fecha Fin</label>
		<input type='date' name='fecha_fin'><br>
        <input type='submit' value='Ver pagos' name='pagos'>

</form>   

<?php

if (isset($_POST) && !empty($_POST)) {

    $inicio=$_POST["fecha_inicio"];
    $fin=$_POST["fecha_fin"];

    $infos=consultarPagos($inicio, $fin);

    if ($infos!=null) {
        ?>

<p>Pagos entre <?php echo $infos["fechas"]["fechainicio"]  ." // "
    . $infos["fechas"]["fechafin"]; ?></p>
<table border="">
<tr>
    <th>Fecha de Pago</th>
    <th>Cantidad</th>
</tr>

<?php
foreach ($infos["datos"] as $info) {
        echo "<tr>
        <td>". $info["InvoiceDate"] ."</td>
        <td>". $info["total"] ." €</td>
     </tr>";
    } ?>


</table>    

<?php
       }
    } else {
            echo"<p>No hay registro de facturas de este cliente entre las fechas indicadas. <p>";
        }
        ?>
<br><br><a href='index.php'>Volver a pagina Login</a>
</body>
</html>



