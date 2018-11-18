<?php
	$conexion = new mysqli("localhost","root", "","cibertyx");

	if ($conexion) {
		echo "";
	}

	if($conexion->connect_errno){
		echo "Error al conectar la Base de Datos - Error: ".$conexion->connect_errno;
	}
?>
