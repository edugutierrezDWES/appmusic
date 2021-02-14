 <!--Código por: Rodrigo Cano--> 
<?php
	session_start();
	
	if(isset($_SESSION["usuario"])){//Comprueba que ha iniciado sesion
		//Llama a la BBDD
		require_once("db/db.php");
		//Llama al controler downmusic
		include_once("controllers/downmusic_controller.php");
		echo "<br><br><br><a href='index.php'>Volver a pagina Login</a>";
	}
	else{
		echo "<br> Acceso Restringido debes hacer Login con tu usuario";
		echo "<br><a href='index.php'>Volver a pagina Login</a>";
	}
?>

