<?php
    
	if ($_SERVER["REQUEST_METHOD"] == "POST") {//Si el formulario ha sido realizado se inicia la funcion user()
		
			$user=crearSesion();
		
	}

?>

<h1>Iniciar Sesion</h1>
<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
	<label for="username">Username:</label>
	<input type="text" name="username" required/><br><br>
	
	<label for="passcode">Passcode:</label>
		<input type="password" name="passcode" required/><br><br>
		<input type="submit" value="Iniciar sesion"/>
</form>
