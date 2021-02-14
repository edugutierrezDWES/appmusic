<!--Código por: Alex Calama--> 
<?php 
session_start();
if(isset($_SESSION["usuario"])){//Comprueba que ha iniciado sesion
   
    
    require_once("db/db.php");
    include_once("controllers/facturas_controller.php");
}else{
		echo "<br> Acceso Restringido debes hacer Login con tu usuario";
		echo "<br><a href='index.php'>Volver a pagina Login</a>";
	}
	
?>
