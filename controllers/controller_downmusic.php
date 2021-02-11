 <!--Código por: Rodrigo Cano--> 
<?php
	include_once("models/modeloMusica.php");
	$canciones=Lista("SELECT * FROM Track");
	include_once("views/view_downmusic.phtml");
?>
