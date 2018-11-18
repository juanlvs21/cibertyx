<?php 
  include("../../config/conexion.php");
  session_start();

  $actual = mysqli_real_escape_string($conexion, md5($_POST['actual']));
  $nueva = mysqli_real_escape_string($conexion, md5($_POST['nueva']));
  $repetir = mysqli_real_escape_string($conexion, md5($_POST['repetir']));
  $pag = mysqli_real_escape_string($conexion, $_POST['pag']);
  $user = $_SESSION['id'];

  $query = ($conexion->query("SELECT contra FROM usuario WHERE id='$user'"))->fetch_assoc();

  if ($actual != $query['contra']) {
    ?>
    <br>
    <center><p class="alert alert-danger">Contraseña actual no coincide</p></center>
    <?php
  }else{
    if ($query['contra'] == $nueva) {
      ?>
      <br>
      <center><p class="alert alert-danger">Error - Contraseña Actual y Contraseña Nueva son iguales</p></center>
      <?php
    }else{
      if ($nueva != $repetir) {
        ?>
        <center><p class="alert alert-danger">Contraseña nueva no coincide</p></center>
        <?php
      }else{
        $querycambiar = $conexion->query("UPDATE usuario SET contra='$nueva' WHERE id='$user'");
        if ($querycambiar) {
          ?>
          <p class="alert alert-success">Datos actualizados con exito</p>
          <?php
          if ($pag == '1') {
            ?>
            <script> 
              console.log('Contraseña actualizada con exito');
              location.href = 'index.php';
            </script>
            <?php
          }
          if ($pag == '2') {
            ?>
            <script> 
              console.log('Contraseña actualizada con exito');
              location.href = 'trabajos.php';
            </script>
            <?php
          }
          if ($pag == '3') {
            ?>
            <script> 
              console.log('Contraseña actualizada con exito');
              location.href = 'terminados.php';
            </script>
            <?php
          }
          if ($pag == '4') {
            ?>
            <script> 
              console.log('Contraseña actualizada con exito');
              location.href = 'usuarios.php';
            </script>
            <?php
          }
        }else{
          ?>
          <br>
          <center><p class="alert alert-danger">Error - Por favor intente más tarde</p></center>
          <?php
        }      
      }
    }
  }
?>