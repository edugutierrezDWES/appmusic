 <!--Código por: Rodrigo Cano--> 

<?php
	include_once("models/downmusic_model.php");
	include_once("api/apiRedsys5_2.php");

	$canciones=consultaLista("SELECT * FROM Track");
	if (!isset($_SESSION['cesta'])) {//Crea la sesion cesta en caso de no existir
		$cesta= [];
		$_SESSION['cesta'] = $cesta;//Se guarda un array vacio
		
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {//Se añade un producto a la cesta
		if (isset($_POST['cesta'])) {
			$cancion = limpiarCampo($_POST["cancion"]);
			$count=count($_SESSION['cesta']);
			$cesta=$_SESSION['cesta'];
			$busqueda="SELECT * FROM Track WHERE Name=N'$cancion'";
			$UnitPrice=busquedaDato("UnitPrice", $busqueda);
			$cesta[$count][$cancion]=$UnitPrice;
			$_SESSION['cesta']=$cesta;
			}

		//para limpiar el carrito	
		if (isset($_POST['vaciar'])){
			$_SESSION['cesta']=[];
		}	
	}
	include_once("views/downmusic_view.php");
?>

