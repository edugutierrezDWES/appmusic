 <!--Código por: Rodrigo Cano--> 
<html>
<head>
<title>Descarga de Musica</title>
</head>
<body>
<?php
	session_start();
	
	if(isset($_SESSION["usuario"])){//Comprueba que ha iniciado sesion
		//Llama a la BBDD
		require_once("db/db.php");
		//Llama al controler downmusic
		include_once("controllers/controller_downmusic.php");
	}
	else{
		echo "<br> Acceso Restringido debes hacer Login con tu usuario";
		echo "<br><a href='pe_login.php'>Volver a pagina Login</a>";
	}
?>

</body>
</html>
