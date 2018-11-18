<?php 
  include('../../config/conexion.php');
  session_start();

  $id = $_SESSION['id'];
  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
  $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
  $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
  $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
  $pag = mysqli_real_escape_string($conexion, $_POST['pag']);

  $query = $conexion->query("UPDATE usuario SET usuario='$usuario',nombre='$nombre', apellido='$apellido', correo='$correo' WHERE id='$id'");

  if ($query) { 
    ?>
    <p class="alert alert-success">Datos actualizados con exito</p>
    <?php
    if ($pag == '1') {
      ?>
      <script> 
        console.log('Datos personales actualizados');
        location.href = 'index.php';
      </script>
      <?php
    }
    if ($pag == '2') {
      ?>
      <script> 
        console.log('Datos personales actualizados');
        location.href = 'trabajos.php';
      </script>
      <?php
    }
    if ($pag == '3') {
      ?>
      <script> 
        console.log('Datos personales actualizados');
        location.href = 'terminados.php';
      </script>
      <?php
    }
    if ($pag == '4') {
      ?>
      <script> 
        console.log('Datos personales actualizados');
        location.href = 'usuarios.php';
      </script>
      <?php
    }
  }else{ ?>
    <p class="alert alert-danger">Error - Por favor intente más tarde</p>
    <script> console.log('Error al actualizar los datos'); </script>
  <?php
  }
?>