<?php
// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

function obtenerFacturas() {

 # Función 'obtenerFacturas'. 
    # Parámetros: 
    # 	NONE
    #
    # Funcionalidad:
    # Obetner todo el historial de facturas de un cliente
    #
    # Retorna: Los datos (InvoiceId , InvoiceDate, Total) de las factiras del Cliente / NULL si no existe el cliente o ha ocurrido un error
    #
    # Código por Edu Gutierrez

	// Aquí utilizaríamos la id del usuario logeado
    $id=$_SESSION["id"];
	global $conexion;

	try {
		$consulta = $conexion->prepare("SELECT InvoiceId , InvoiceDate, Total FROM Invoice WHERE CustomerId=:id ");
		$consulta->bindParam(":id", $id);
		$consulta->execute();
		$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);
		return !empty($datos)? $datos: null;

	} catch (PDOException $ex) {
		echo "<p>Ha ocurrido un error al devolver los datos de las facturas <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
		return null;
	}
}

?>
