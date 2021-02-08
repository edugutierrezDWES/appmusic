<?php
echo "Inicio controller"."<br>";
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/facturas_model.php");

$facturas=obtenerFacturas();

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/facturas_view.php");
?>