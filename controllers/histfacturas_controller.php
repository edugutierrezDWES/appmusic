<?php
echo "Inicio controller"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/histfacturas_model.php");

$facturas=obtenerFacturas();

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/histfacturas_view.php");
?>
