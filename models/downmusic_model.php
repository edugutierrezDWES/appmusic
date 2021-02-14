<?php
	function ejecutarCadena($cadena){
	# Función 'Ejecutar'. 
	# Parámetros: 
	# 	- $cadena 
	#
	#
	# Funcionalidad:
	# Ejecutar la cadena en la bbdd ej:select, update, insert.
	#
	# Retorna: True en caso de que hizo correctamente / False si hubo algun error en el proceso.
	#
	#  Código por Rodrigo Cano
		
		
		//Codifique una cadena ISO-8859-1 en UTF-8:
		$cadena=utf8_encode($cadena);
		global $conexion;
		try {
		    // set the PDO error mode to exception
		   $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		   $sql = $cadena;
		   $conexion->exec($sql);
		   return true;
		    }
		catch(PDOException $e)
		    {
		    echo "Error: " . $e->getMessage()."<br>";
		    return false;
		    }
	}
	function consultaLista($tabla) {
	# Función 'Lista'. 
	# Parámetros: 
	# 	- $lista 
	#		-$tabla
	#
	# Funcionalidad:
	# Mostrar las opciones en una lista de una sola colunma
	#
	# Retorna:
	#
	#  Código por Rodrigo Cano
		global $conexion;
		try {
		    $obtenerInfo = $conexion->prepare($tabla);
		    $obtenerInfo->execute();
		    return $obtenerInfo->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
	}
	function limpiarCampo($campoformulario) {
	$campoformulario = trim($campoformulario); //elimina espacios en blanco por izquierda/derecha
	$campoformulario = stripslashes($campoformulario); //elimina la barra de escape "\", utilizada para escapar caracteres
	$campoformulario = htmlspecialchars($campoformulario);  
	return $campoformulario;  
	}
	function mostrarCesta($canciones)
	{
	# Función 'MostrarCesta'. 
	# Parámetros: 
	# 	- $cesta 
	#	
	#
	# Funcionalidad:
	# Muestra en una tabla el array cesta de dos columnas, el nombre del producto y la cantidad que pedimos
	#
	# Retorna:
	#
	#  Código por Rodrigo Cano
		
		echo "<h3>Cesta</h3>";
		echo "<table class='table table-bordered' border='1'>";
		echo "<tr style='background-color:#85C3F4'>";
		echo "<th>Canciones</th><th>Precio</th>";
		echo "</tr>";
		$total=0;
		for ($i=0; $i < count($canciones) ; $i++) { 
				$cesta=$_SESSION['cesta'][$i];
				
				foreach ($cesta as $cancion => $UnitPrice) {
					echo "<tr>";
					echo "<td>$cancion</td><td>$UnitPrice</td>";
					echo "</tr>";
					$total+=doubleval($UnitPrice);
				}
		}
		
		echo "<tr style='background-color:#82E52B'>";
		echo "<td>Monto Total</td><td>$total</td>";
		echo "</tr>";
		echo "</table>";
		return $total;
	}

	function busquedaDato($lista, $busqueda) {
	# Función 'dato'. 
	# Parámetros: 
	# 	- $lista 
	#		-$busqueda
	#
	# Funcionalidad:
	# Buscar con un select un dato en concreto de limite 1
	#
	# Retorna: Un dato de la tabla / "" en caso de no encontrar
	#
	#  Código por Rodrigo Cano
		 $codigo="";
		try{
		   global $conexion;
		   $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   $stmt = $conexion->prepare($busqueda);
		   $stmt->execute();
			// set the resulting array to associative
		   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		  
			foreach($stmt->fetchAll() as $row) {
		       $codigo=$row["$lista"];
		   }
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
		return $codigo;
	}
	function busquedaDatosLinea($busqueda) {
	# Función 'datos'. 
	# Parámetros: 
	# 	- $lista 
	#		-$busqueda
	#
	# Funcionalidad:
	# Buscar con un select un datos en concreto de una linea
	#
	# Retorna: Datos de la tabla / [] en caso de no encontrar
	#
	#  Código por Rodrigo Cano
		global $conexion;
		try{
		   $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   $obtenerInfo = $conexion->prepare($busqueda);
		   $obtenerInfo->execute();
			// set the resulting array to associative
		   $obtenerInfo->setFetchMode(PDO::FETCH_ASSOC);
		   foreach($obtenerInfo->fetchAll() as $row) {
		       return $row;
		   }
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
	}
?>
