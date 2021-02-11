<?php
	function Lista($tabla) {
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
		$conn = null;
	}
	function limpiar_campo($campoformulario) {
	$campoformulario = trim($campoformulario); //elimina espacios en blanco por izquierda/derecha
	$campoformulario = stripslashes($campoformulario); //elimina la barra de escape "\", utilizada para escapar caracteres
	$campoformulario = htmlspecialchars($campoformulario);  
	return $campoformulario;  
	}
	function MostrarCesta($cesta)
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
		echo "<tr>";
		echo "<th>Lista</th>";
		echo "</tr>";
		foreach ($cesta as $cancion => $nada) {
			echo "<tr>";
			echo "<td>$cancion</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

?>