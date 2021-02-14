<?php


function consultarPagos($fecha_inicio, $fecha_fin){
    # Función 'consultarPagos'. 
    # Parámetros: 
    #	- $fecha_inicio (fecha de inicio, desde la cual se empieza a buscar en el historial)
    #	- $fecha_fin (fecha de fin, desde la cual se termina de buscar en el historial)
    # Funcionalidad:
    # Obtiene las pagos relizadas por un cliente entre dos fechas.
    # Retorna: Los fechas y cantidades de esos pagos sino retorna null
    # Código por Alex Calama

    
        global $conexion;

        // Para evitar más de una consulta, en el caso de histórico la fecha de inicio será 2000-01-01 y la de fin la fecha actual
        if($fecha_inicio==null) $fecha_inicio="2000-01-01"; 
        if ($fecha_fin==null) $fecha_fin=date("Y-m-d");
    
    
        // En el caso que se hayan puesto las fechas en order contrario, las invertimos para que no haya problemas en la consulta.  
        if ($fecha_inicio > $fecha_fin) {

            $aux=$fecha_inicio;
            $fecha_inicio=$fecha_fin;
            $fecha_fin=$aux;

        }  
        try {
            //cambiar select
            $consulta = $conexion->prepare("SELECT InvoiceDate,total FROM invoice WHERE CustomerId = :id and (InvoiceDate  >= :fechaInicio and InvoiceDate <= :fechaFin) ORDER BY total DESC");
            $consulta->bindParam(":fechaInicio", $fecha_inicio);
            $consulta->bindParam(":fechaFin", $fecha_fin);
            $consulta->bindParam(":id",$_SESSION["id"]);
            $consulta->execute();

            $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);
            $fechas=array("fechainicio"=>$fecha_inicio,"fechafin"=>$fecha_fin);

            // Devolvemos también las fechas para poder ponerlas luego por pantalla
            $respuesta=array("datos"=>$datos, "fechas"=>$fechas);
            return !empty($respuesta["datos"])? $respuesta: null;

        } catch(PDOException $ex) {

            echo "<p>Ha ocurrido un error al devolver las facturas que ha realizado este cliente: <span style='color: red; font-weight: bold;'>". $ex->getMessage()."</span></p></br>";
            return null;
        } 
    }

?>