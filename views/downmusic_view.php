  <!--Código por: Rodrigo Cano--> 
  <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<title>Descargar Música</title>
</head>
<body>
<?php

$TotalPrecio=0;
	if (isset($_SESSION['cesta']) && count($_SESSION['cesta'])>0 )
		$TotalPrecio=mostrarCesta($_SESSION['cesta']);

if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	if(isset($_POST['compraFin'])){
		if (count($_SESSION['cesta'])>0) {

			$amount = doubleval($TotalPrecio*100);

			// Se incluye la librería
			// Se crea Objeto
			$miObj = new RedsysAPI;
	
			// Valores de entrada
			$fuc = "999008881";
			$terminal = "01";
			$moneda = "978";
			$trans = "0";
			$url = "";
			$urlOKKO = ../controllers/pagook.php;
			$urlKOOK = ../controllers/pagoko.php;
			$id = time();
	
			// Se Rellenan los campos
			$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
			$miObj->setParameter("DS_MERCHANT_ORDER", strval($id));
			$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
			$miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
			$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
			$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
			$miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
			$miObj->setParameter("DS_MERCHANT_URLOK", $urlOKKO);
			$miObj->setParameter("DS_MERCHANT_URLKO", $urlKOOK);
	
			//Datos de configuración
			$version = "HMAC_SHA256_V1";
			$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'; //Clave recuperada de CANALES
			// Se generan los parámetros de la petición
			$request = "";
			$params = $miObj->createMerchantParameters();
			$signature = $miObj->createMerchantSignature($kc);

			?>
			 <form name="realizarPago" id="realizarPago" action="https://sis-i.redsys.es:25443/sis/realizarPago" method="post" target="_blank">
				<input type="hidden" name="Ds_SignatureVersion" value="<?php echo $version; ?>" /></br>
				<input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>" /></br>
				<input type="hidden" name="Ds_Signature" value="<?php echo $signature; ?>" /></br>
			</form>
			<script>
				$(document).ready(function() {
					$("#realizarPago").submit();
				});
			</script>
			<?php
			
		}
		else {
			echo "<br> No tienes ningun producto en la cesta";
			echo "<br><a href='downmusic.php'>Recargar Pagina</a>";
		}
	}
}

	if(!isset($_POST['compraFin']))
	{
		?>
		<h2>Musica<h2>
		<form name="downmusic" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
		<select name='cancion'>
		<?php
	            foreach ($canciones as $cancion) {
	                echo "<option>" . $cancion["Name"]. "</option>";
	            }
				?>
		</select><br>
		<input type='submit' value='Añadir Cesta' name='cesta'>
		<input type='submit' value='Finalizar Compra' name='compraFin'><br>
		<input type="submit" value="Vaciar Carrito" name="vaciar">

    <?php
	}
?>	
</body>
</html>




