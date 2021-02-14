<?php
	if (isset($_SESSION["usuario"])) {//Si exista dicha sesión se muestra el indice

		$log = $_SESSION["usuario"];
		?>
<h1> Bienvenido <span style="color: gray;"><?php echo $log;?></span></h1>

	<li><a href="downmusic.php">Descargar canciones</a></li>
	<li><a href="histfacturas.php">Historial facturas</a></li>
	<li><a href="facturas.php">Consulta facturas</a></li>
	<li><a href="ranking.php">Ranking</a></li>
    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
    

<?php	} else {

		// Si el usuario NO ha iniciado sesión se redirige a "index.php"
		header("location: ../index.php"); 
		
	}
?>