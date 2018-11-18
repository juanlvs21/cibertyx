<?php 
  include('../config/conexion.php');

  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
  $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
  $solicitud = mysqli_real_escape_string($conexion, $_POST['solicitud']);
  $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);


  $fechacod = date(ymd);
  
  $codigo = $fechacod."-".substr(strtoupper(md5(microtime(true))),0,10);

  if (($nombre == "") || ($correo == "") || ($descripcion == "") || ($solicitud =="")) {
    ?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      Error - Uno de los campos se encuentra vacio
    </div>
    <script> console.log('Error al enviar solicitud, datos vacios'); </script>
    <?php
  }else{
    $query = "INSERT INTO solicitud (codigo,nombre,correo,solicitud,descripcion,fecha) VALUES ('$codigo','$nombre','$correo','$solicitud','$descripcion',now())";
    $result = $conexion->query($query);

    $querybuscar = $conexion->query("SELECT id FROM solicitud WHERE codigo='$codigo'");
    $buscar = $querybuscar->fetch_assoc();
    $buscarcod = $buscar['id'];

    $querylog = $conexion->query("INSERT INTO logsolic (idsolic,fecha) VALUES ('$buscarcod',now())");

    if ($result) { ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Solicitud enviada con exito. ¡GRACIAS!
      </div>
      <script> 
        console.log('Solicitud de servicio enviada con exito');
        document.getElementById('nombre').value='';
        document.getElementById('correo').value='';
        document.getElementById('descripcion').value='';
        $('#solicitud').val('Blog Personal');
        alert('Solicitud enviada con exito. ¡GRACIAS!');       
        location.href = '/cibertyx/contacto';
      </script>
    <?php
    }else{ ?>
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Error - Por favor intente más tarde
      </div>
      <script> console.log('Error al enviar solicitud'); </script>
    <?php
    }    
  }

?>