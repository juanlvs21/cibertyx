<?php 
    include("../../config/conexion.php");
    session_start();
    
	$id = mysqli_real_escape_string($conexion,$_POST['id']);
	$estado = mysqli_real_escape_string($conexion,$_POST['estado']);
	$tipo = mysqli_real_escape_string($conexion,$_POST['tipo']);

	$user = $_SESSION['id'];
	$accion1m = "Ha marcado la solicitud como REVISADA";
	$accion1d = "Ha desmarcado la solicitud como REVISADA";
	$accion2m = "Ha marcado la solicitud como EN EJECUCION";
	$accion2d = "Ha desmarcado la solicitud como EN EJECUCION";
	$accion3m = "Ha marcado la solicitud como TERMINADA";
	$accion3d = "Ha desmarcado la solicitud como TERMINADA";
	$accion4m = "Ha marcado la solicitud como RECHAZADA";
	$accion4d = "Ha desmarcado la solicitud como RECHAZADA";

	if ($tipo == 1) {
		if ($estado == 0) {
	  		$query = $conexion->query("UPDATE solicitud SET revisada='1' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion1m', now())");
		}

		if ($estado == 1) {
	  		$query = $conexion->query("UPDATE solicitud SET revisada='0',rechazada='0',ejecucion='0',terminada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion1d', now())");
		}
	}

	if ($tipo == 2) {
		if ($estado == 0) {
	  		$query = $conexion->query("UPDATE solicitud SET ejecucion='1',revisada='1',rechazada='0',terminada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion2m', now())");
		}

		if ($estado == 1) {
	  		$query = $conexion->query("UPDATE solicitud SET ejecucion='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion2d', now())");
		}
	}

	if ($tipo == 3) {
		if ($estado == 0) {
	  		$query = $conexion->query("UPDATE solicitud SET terminada='1',revisada='1',ejecucion='0',rechazada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion3m', now())");
		}

		if ($estado == 1) {
	  		$query = $conexion->query("UPDATE solicitud SET terminada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion3d', now())");
		}
	}


	if ($tipo == 4) {
		if ($estado == 0) {
	  		$query = $conexion->query("UPDATE solicitud SET rechazada='1',revisada='1',ejecucion='0',terminada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion4m', now())");
		}

		if ($estado == 1) {
	  		$query = $conexion->query("UPDATE solicitud SET rechazada='0' WHERE id='$id'");
	  		$query2 = $conexion->query("INSERT INTO logrevisar (iduser,idsolic,accion,fecha) values ('$user','$id','$accion4d', now())");
		}
	}
	
	if($query){		
		?>
	    <script> 
	      console.log('Estado ha sido actualizado con exito');
	      location.href = 'trabajos.php';
	    </script>
		<?php
	}else{
		?>
		<script>console.log('Error al marcar solicitud');</script>
		<?php					
	}
	
?>