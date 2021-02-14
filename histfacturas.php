<?php
session_start();
if(isset($_SESSION["usuario"])){//Comprueba que ha iniciado sesion
    
    // Llamada al fichero que inicia la conexión a la Base de Datos
    require_once("db/db.php");

    // Llamada al controlador
    require_once("controllers/histfacturas_controller.php");
} else {
    echo "<br> Acceso Restringido debes hacer Login con tu usuario";
    echo "<br><a href='index.php'>Volver a pagina Login</a>";

}


?>
