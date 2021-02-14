<?php
session_start();
function crearSesion(){ 
/*
Funcion user()

Crea la sesion para el registro, llama a comrpobarLogin() y
reenvia la página a inicio_view
*/
	
	if(isset($_SESSION['usuario'])){
		session_unset();
		session_destroy();
	}
	
	if (isset($_POST) && !empty($_POST)) {

		$user = $_POST["username"];
		$pass = $_POST["passcode"];
		
		$consulta = comprobarLogin($user, $pass);

		if($consulta != null){
			$_SESSION["usuario"] = $consulta["Email"];
			$_SESSION["id"] = $consulta["CustomerId"];
			header("location: views/inicio_view.php");
		}	
	}
	
}

function comprobarLogin($user, $pass) {
	
/*
Funcion comprobarLogin($user, $pass)
Parametros: usuario y contraseña

Realiza un select para comprobar si el usuario (Email)
coincide con la contraseña (LastName)

Retorna $datos[i]
*/
		global $conexion;
	try {
		$consulta = $conexion->prepare("SELECT LastName, Email, CustomerId FROM Customer WHERE Email = :username");
		$consulta->bindParam(":username", $user);
		$consulta->execute();
		$datos = $consulta -> fetch(PDO::FETCH_ASSOC);

		//cambio realizado para comprobar sin necesidad de recorrer ningún array
		return ($datos["LastName"]==$pass)? $datos : null;

	} catch (PDOException $ex) {
		echo "<p>Ha ocurrido un error al devolver los datos. <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
		return null;
	}
}

?>