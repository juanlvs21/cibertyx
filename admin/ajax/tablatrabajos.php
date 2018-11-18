<?php
  include("../../config/conexion.php");
    
  $estado = mysqli_real_escape_string($conexion,$_POST['estado']);

  if ($estado == '1') {
    $query = $conexion->query("SELECT * FROM solicitud");
  }
  if ($estado == '2') {
    $query = $conexion->query("SELECT * FROM solicitud WHERE revisada='1'");
  }
  if ($estado == '3') {
    $query = $conexion->query("SELECT * FROM solicitud WHERE ejecucion='1'");
  }
  if ($estado == '4') {
    $query = $conexion->query("SELECT * FROM solicitud WHERE rechazada='1'");
  }

  while ($solicitud = $query->fetch_assoc()) {
    $descrip = explode(" ", $solicitud['descripcion']);
    $descrip1 = "";
    $i = 0;
    if (count($descrip) > 5) {
      for ($i=0; $i < 5; $i++) { 
        $descrip1 = $descrip1." ".$descrip[$i];
      }
        $descrip1 = $descrip1." . . .";
    }else{
      for ($i=0; $i < count($descrip); $i++) { 
        $descrip1 = $descrip1." ".$descrip[$i];
      }
    }

    $idsolic = $solicitud['id'];
    $nombsolic = $solicitud['nombre'];
    $correosolic = $solicitud['correo'];
    $tiposolic = $solicitud['solicitud'];
    $fechsolic = $solicitud['fecha'];
    $descripcomple = $solicitud['descripcion'];
    ?>
    <tr>
      <td><?php echo $solicitud['fecha']; ?></td>
      <td><?php echo $nombsolic ?></td>
      <td><?php echo $correosolic ?></td>
      <td><?php echo $tiposolic ?></td>
      <td>
        <a class="nav-link" href="" data-toggle="modal" data-target="#modalsolicitud" onclick="cargarsolicitud('<?php echo $nombsolic ?>','<?php echo $correosolic ?>','<?php echo $tiposolic ?>','<?php echo $fechsolic ?>','<?php echo $descripcomple ?>')"><?php echo $descrip1 ?></a>
      </td>
      <td>
        <center>
          <script>
            function marcar(id,estado,tipo){
                  $('#loadingtabla').removeClass('hidden');

                  var datos = "id="+id;
                      datos += '&estado='+estado;
                      datos += '&tipo='+tipo;

                  $.ajax({
                    type: "POST",
                        url: "ajax/marcar.php",
                        data: datos,
                        dataType:"html",
                        asycn:false,
                        success: function(){
                          console.log('Datos enviados - Marcar estado solicitud ');
                          $('#loadingtabla').addClass('hidden');
                        }
                  })
                  .done(function(respuesta){
                    console.log('Consulta realizada - Marcar estado solicitud ');
                    $("#respuestaajax").html(respuesta);
                  })
                  .fail(function(respuesta){
                    console.log('Error petición ajax - Marcar estado solicitud ');
                  })
            }                         
          </script>                    
          <?php 
          if ($solicitud['revisada'] == 1) {
            ?>
            <i class="fa fa-eye" style="color: purple" title="Solicitud Revisada - ¿Desmarcar?" onclick="marcar('<?php echo $idsolic ?>','1','1')"></i>
            <?php
          }else{
            ?>
            <i class="fa fa-eye" style="color: #a7a7a7" title="¿Marcar como Revisada?" onclick="marcar('<?php echo $idsolic ?>','0','1')"></i>
            <?php
          }
          //-----------
          if ($solicitud['ejecucion'] == 1) {
            ?>
            <i class="fa fa-cog" style="color: blue" title="Trabajo en Ejecución - ¿Desmarcar?" onclick="marcar('<?php echo $idsolic ?>','1','2')"></i>
            <?php
          }else{
            ?>
            <i class="fa fa-cog" style="color: #a7a7a7" title="¿Trabajo en Ejecución?" onclick="marcar('<?php echo $idsolic ?>','0','2')"></i>
            <?php
          }
          ?>
          <br>
          <?php
          //-----------
          if ($solicitud['terminada'] == 1) {
            ?>
            <i class="fa fa-check-circle" style="color: green  " title="Trabajo Terminado - ¿Desmarcar?" onclick="marcar('<?php echo $idsolic ?>','1','3')"></i>
            <?php
          }else{
            ?>
            <i class="fa fa-check-circle" style="color: #a7a7a7" title="¿Trabajo Terminado?" data-toggle="modal" data-target="#modalterminar" onclick="cargarterminar('<?php echo $idsolic ?>','<?php echo $nombsolic ?>','<?php echo $correosolic ?>','<?php echo $tiposolic ?>','<?php echo $fechsolic ?>')"></i>
            <?php
          }
          //-----------
          if ($solicitud['rechazada'] == 1) {
            ?>
            <i class="fa fa-ban" style="color: red" title="Solicitud Rechazada - ¿Desmarcar?" onclick="marcar('<?php echo $idsolic ?>','1','4')"></i>
            <?php
          }else{
            ?>
            <i class="fa fa-ban" style="color: #a7a7a7" title="¿Rechazar Trabajo?" onclick="marcar('<?php echo $idsolic ?>','0','4')"></i>
            <?php
          }
          ?>
          <div id="respuestaajax"></div>                        
        </center>
      </td>
    </tr>
    <?php
  }
?>