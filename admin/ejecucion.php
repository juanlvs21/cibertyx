<?php
    include("../config/conexion.php");

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    //Buscando  usuario
    $usuario =  $_SESSION['usuario'];
    $queryuser = $conexion->query("SELECT id,usuario,nombre,apellido,correo,contra FROM usuario WHERE usuario='$usuario'");
    $user = $queryuser->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CIBERTYX | Administrar Trabajos en Ejecución</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<style type="text/css"> 
  .hidden{
    display: none;
  }
</style>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">CIBERTYX</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inicio">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Trabajos">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#trabajos" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Trabajos</span>
          </a>
          <ul class="sidenav-second-level collapse" id="trabajos">
            <li class="active">
              <a href="trabajos.php">Total</a>
            </li>
            <li class="active">
              <a href="ejecucion.php">En Ejecución</a>
            </li>
            <li>
              <a href="tables.html">Terminados</a>
            </li>
            <li>
              <a href="tables.html">Rechazados</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuario">
          <a class="nav-link" href="usuarios.php">
            <i class="fa fa-fw fa-group"></i>
            <span class="nav-link-text">Usuarios</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Perfil">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#perfil" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Perfil</span>
          </a>
          <ul class="sidenav-second-level collapse" id="perfil">
            <li>
              <a class="nav-link" data-toggle="modal" data-target="#modalperfil">Datos Personales</a>
            </li>
            <li>
              <a class="nav-link" data-toggle="modal" data-target="#modalcontra">Cambiar Contraseña</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link">
            <i class=""></i>Bienvenido <?php echo $user['nombre']." ".$user['apellido'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#modalsalir">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">CIBERTYX</a>
        </li>
        <li class="breadcrumb-item active"><a href="trabajos.php">Total Trabajos</a></li>
        <li class="breadcrumb-item active"><a href="ejecucion.php">Trabajos en Ejecución</a></li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Lista de Trabajos en Ejecución
        </div>
        <div class="card-body">
          <center>
            <img src="../img/loading.gif" style="height: 60px; width: auto" class="hidden" id="loadingtabla">
          </center>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Solicitante</th>
                  <th>Correo Solicitante</th>
                  <th>Solicitud</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Fecha</th>
                  <th>Solicitante</th>
                  <th>Correo Solicitante</th>
                  <th>Solicitud</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $query = $conexion->query("SELECT * FROM solicitud WHERE ejecucion='1'");

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
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Ultima solicitud recibida: <?php echo $fechsolic ?></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © CIBERTYX 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="modalsalir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
              ¿Estas seguro que quieres cerrar sesión
              <br>
              <small>Al cerrar sesión se saldrá del sistema</small>
            </center>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="salir.php">Salir</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Solicitud Modal-->
    <div class="modal fade" id="modalsolicitud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Solicitud</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div> 
                <b>Solicitante: </b>
                <a id="solicitantem"> </a>
            </div>
            <div> 
                <b>Correo Electrónico: </b>
                <a id="correom"> </a>
            </div>
            <div> 
                <b>Solicitud: </b>
                <a id="solicitudm"> </a>
            </div>
            <div> 
                <b>Fecha: </b>
                <a id="fecham"> </a>
            </div>
            <div>
                <b>Descripción: </b>
                <p id="descripcionm"> </p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>    


    <!-- Terminar Trabajo Modal-->
    <div class="modal fade" id="modalterminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Trabajo Terminado?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div> 
                <b>Solicitante: </b>
                <a id="solicitantemt"> </a>
            </div>
            <div> 
                <b>Correo Electrónico: </b>
                <a id="correomt"> </a>
            </div>
            <div> 
                <b>Solicitud: </b>
                <a id="solicitudmt"> </a>
            </div>
            <div> 
                <b>Fecha: </b>
                <a id="fechamt"> </a>
            </div>
          </div>
          <div class="container">
            <form method="post" id="formterminar" enctype="multipart/form-data">
              <input type="text" name="idmodaltrab" id="idmodaltrab" value="" hidden="">
              <div class="form-group">
                <label for="titulop">Titulo Proyecto: </label>
                <input type="text" class="form-control" name="titulop" id="titulop">
              </div>
              <div class="form-group">
                <label for="urlp">URL: <small>(Dirección Web)</small></label>
                <input type="text" class="form-control" name="urlp" id="urlp">
              </div>
              <div class="form-group">
                <label for="imgt">Imagen: </label>
                <input type="file" class="form-control" name="imgt" id="imgt">
              </div>
              <div class="form-group">
                <center>
                  <button class="btn btn-success" type="submit" id="btnterminado" name="btnterminado">Publicar como Terminado</button>
                </center>
              </div>
            </form>

            <?php 
            if(isset($_POST['btnterminado'])){
              $idmodaltrab = mysqli_real_escape_string($conexion, $_POST['idmodaltrab']);
              $titulop = mysqli_real_escape_string($conexion, $_POST['titulop']);
              $urlp = mysqli_real_escape_string($conexion, $_POST['urlp']);
              
              $nombreimg = $_FILES['imgt']['name'];
              $nombreimgr = strtolower($nombreimg);
              $cd = $_FILES['imgt']['tmp_name'];
              $ruta = "../img/trabajos/".$_FILES['imgt']['name'];

              $query = $conexion->query("UPDATE solicitud SET nombreproyecto='$titulop', img='$nombreimgr', url='$urlp', terminada='1', revisada='1', rechazada='0', ejecucion='0' WHERE id='$idmodaltrab'");

              if ($query) {
                $resultado = @move_uploaded_file($cd, $ruta);

                if (!empty($resultado)) {
                  ?>
                  <script>
                    idmt = document.getElementById('idmodaltrab').value;
                    console.log('Imagen subida - Imagen Proyecto');
                    location.href = 'trabajos.php';
                  </script>
                  <?php
                }else{
                  $query2 = $conexion->query("UPDATE solicitud SET nombreproyecto='', img='' WHERE id='$idmodaltrab'");
                  ?>
                  <script>
                    console.log('Error al subir imagen - Imagen Proyecto');
                  </script>
                  <?php
                }
              }else{
                ?>
                <script>
                  console.log('Error al hacer la consulta sql  - Imagen Proyecto');
                </script>
                <?php    
              }
              ?>
              <script type="text/javascript">\
                    //location.href = 'trabajos.php';
                    //window.location.href = 'trabajos.php';
                    //location.reload(true);
                    //window.location.replace('trabajos.php');
              </script>
              <?php
            }
            ?>

            <div id="retornoimagen"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>        

    <!-- Cargar Modal JavaScript-->
    <script type="text/javascript">
      function cargarsolicitud(nombsolic,correosolic,tiposolic,fechsolic,descrip1){
        document.getElementById('solicitantem').innerHTML = nombsolic;
        document.getElementById('correom').innerHTML = correosolic;
        document.getElementById('solicitudm').innerHTML = tiposolic;
        document.getElementById('fecham').innerHTML = fechsolic;
        document.getElementById('descripcionm').innerHTML = descrip1;
      }

      function cargarterminar(idsolict,nombsolict,correosolict,tiposolict,fechsolict){
        document.getElementById('solicitantemt').innerHTML = nombsolict;
        document.getElementById('correomt').innerHTML = correosolict;
        document.getElementById('solicitudmt').innerHTML = tiposolict;
        document.getElementById('fechamt').innerHTML = fechsolict; 
        $('#idmodaltrab').val(idsolict);
        $('#fechamodaltrab').val(fechsolict);
      }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
