<?php 
    include("../../config/conexion.php");
    
	$id = mysqli_real_escape_string($conexion,$_POST['id']);

	$query = $conexion->query("SELECT admin FROM usuario WHERE id='$id'");
	$usuario =  $query->fetch_assoc();
	$admin = $usuario['admin'];

	if ($query) {

		if ($admin == '1') {
			$query2 = $conexion->query("UPDATE usuario SET admin='0' WHERE id='$id'");
		}
		if ($admin == '0') {
			$query2 = $conexion->query("UPDATE usuario SET admin='1' WHERE id='$id'");
		}
		
		if($query2){		
			?>
		    <script> 
		      console.log('Admin/User cambiado exitosamente');
		      location.href = 'usuarios.php';
		    </script>
			<?php
		}else{
			?>
			<script>console.log('Error al cambiar Admin/User');</script>
			<?php					
		}
	}else{
		?>
		<script>console.log('Usuario no econtrado');</script>
		<?php
	}
	 
	
?>