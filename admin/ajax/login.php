<?php 
	include('../../config/conexion.php');
	session_start();

	$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
	$contra = mysqli_real_escape_string($conexion, md5($_POST['contra']));

	$query = $conexion->query("SELECT id,usuario,contra FROM usuario WHERE usuario='$usuario'");
	$row = $query->num_rows;
	$result = $query->fetch_assoc();

	if ($row > 0) {
        if ($result['contra'] != $contra) {
            ?>
            <br>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
                <center>Contraseña Incorrecta</center>
            </div>
            <script type="text/javascript">
                $('#loadingregister').addClass('hidden');
            </script>
            <?php   
        }else{  
            $_SESSION['id'] = $result['id'];
            $iduser = $result['id'];    

            $query2 = $conexion->query("INSERT INTO loguser (iduser,fecha) values ('$iduser',now())");
            if ($query2) {
                ?>
                <script type="text/javascript">
                    console.log("Log guardado correctamente");
                </script>
                <?php
            }else{
                ?>
                <script type="text/javascript">
                    console.log("No se pudo guardar el log");
                </script>
                <?php
            }

            ?>
            <script type="text/javascript">
                setTimeout(function(){
                    $('#loadingregister').addClass('hidden');
                    location.href = 'index.php'
                },1000);
            </script>
            <?php   
        }
	}else{
		?>
        <br>
        <div class="alert alert-danger alert-dismissible">
        	<button type="button" class="close" name="button2" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<center>Usuario Invalido</center>
        </div>
        <script type="text/javascript">
            $('#loadingregister').addClass('hidden');
        </script>
		<?php	
	}
?>
