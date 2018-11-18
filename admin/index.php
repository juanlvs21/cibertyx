<?php
    include("../config/conexion.php");

    session_start();

    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
    }

    //Buscando  usuario
    $usuario =  $_SESSION['id'];
    $queryuser = $conexion->query("SELECT id,usuario,nombre,apellido,correo,contra,admin FROM usuario WHERE id='$usuario'");
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
  <title>CIBERTYX | Administrar</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">CIBERTYX</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Inicio">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Trabajos">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#trabajos" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Trabajos</span>
          </a>
          <ul class="sidenav-second-level collapse" id="trabajos">
            <li>
              <a href="trabajos.php">Solicitudes</a>
            </li>
            <li>
              <a href="terminados.php">Terminados</a>
            </li>
          </ul>
        </li>
        <?php 
        if ($user['admin'] == '1') {
          ?>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuario">
            <a class="nav-link" href="usuarios.php">
              <i class="fa fa-fw fa-group"></i>
              <span class="nav-link-text">Usuarios</span>
            </a>
          </li>
          <?php
        }
        ?>
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
        <li class="breadcrumb-item active"><a href="index.php">Inicio</a></li>
      </ol>
      <!-- Icon Cards-->
      <?php 
        $querytrab = $conexion->query('SELECT id FROM solicitud');
        $numtrab = $querytrab->num_rows;

        $querytrabejecu = $conexion->query("SELECT id FROM solicitud WHERE ejecucion='1'");
        $numtrabejecu = $querytrabejecu->num_rows;

        $querytrabtermi = $conexion->query("SELECT id FROM solicitud WHERE terminada='1'");
        $numtrabtermi = $querytrabtermi->num_rows;

        $querytrabrech = $conexion->query("SELECT id FROM solicitud WHERE rechazada='1'");
        $numtrabrech = $querytrabrech->num_rows;
      ?>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-filter"></i>
              </div>
              <div class="mr-5">Total Solicitudes: <b style="color: black; font-size:20px;"><?php echo $numtrab ?></b>
              </div>
            </div>
            <!--a class="card-footer text-white clearfix small z-1" href="trabajos.php">
              <span class="float-left">Ver Detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a-->
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-cog"></i>
              </div>
              <div class="mr-5">En Ejecución: <b style="color: black; font-size:20px;"><?php echo $numtrabejecu ?></b></div>
            </div>
            <!--a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Ver Detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span-->
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-check-circle"></i>
              </div>
              <div class="mr-5">Terminados: <b style="color: black; font-size:20px;"><?php echo $numtrabtermi ?></b></div>
            </div>
            <!--a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Ver Detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span-->
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-ban"></i>
              </div>
              <div class="mr-5">Rechazadas: <b style="color: black; font-size:20px;"><?php echo $numtrabrech ?></b></div>
            </div>
            <!--a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Ver Detalles</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span-->
            </a>
          </div>
        </div>
      </div>
      <!-- Area Graficas-->
      <?php 

      $querymeses = $conexion->query("SELECT fecha FROM solicitud");

      $enero = 0;
      $febrero = 0;
      $marzo = 0;
      $abril = 0;
      $mayo = 0;
      $junio = 0;
      $julio = 0;
      $agosto = 0;
      $septiembre = 0;
      $octubre = 0;
      $noviembre = 0;
      $diciembre  = 0;

      $now = date("Y-m-d");
      $year = date_format((new DateTime($now)), 'Y'); 

      while($meses = $querymeses->fetch_assoc()){
        $fechformat = date_format((new DateTime($meses['fecha'])), 'Y-m-d'); 
        $fechexplode = explode("-",$fechformat);
        $ft = $fechexplode[1];
        $yy = $fechexplode[0];

        if ($year == $yy) {
          if ($ft == "01") {
              $enero = $enero + 1;
          } 
          if ($ft == "02") {
              $febrero = $febrero + 1;
          } 
          if ($ft == "03") {
              $marzo = $marzo + 1;
          } 
          if ($ft == "04") {
              $abril = $abril + 1;
          } 
          if ($ft == "05") {
              $mayo = $mayo + 1;
          } 
          if ($ft == "06") {
              $junio = $junio + 1;
          } 
          if ($ft == "07") {
              $julio = $julio + 1;
          } 
          if ($ft == "08") {
              $agosto = $agosto + 1;
          } 
          if ($ft == "09") {
              $septiembre = $septiembre + 1;
          } 
          if ($ft == "10") {
              $octubre = $octubre + 1;
          } 
          if ($ft == "11") {
              $noviembre = $noviembre + 1;
          } 
          if ($ft == "12") {
              $diciembre = $diciembre + 1;
          } 
        }

      }
      ?>
      <input type="hidden" id="enero" value="<?php echo $enero ?>">
      <input type="hidden" id="febrero" value="<?php echo $febrero ?>">
      <input type="hidden" id="marzo" value="<?php echo $marzo ?>">
      <input type="hidden" id="abril" value="<?php echo $abril ?>">
      <input type="hidden" id="mayo" value="<?php echo $mayo ?>">
      <input type="hidden" id="junio" value="<?php echo $junio ?>">
      <input type="hidden" id="julio" value="<?php echo $julio ?>">
      <input type="hidden" id="agosto" value="<?php echo $agosto ?>">
      <input type="hidden" id="septiembre" value="<?php echo $septiembre ?>">
      <input type="hidden" id="octubre" value="<?php echo $octubre ?>">
      <input type="hidden" id="noviembre" value="<?php echo $noviembre ?>">
      <input type="hidden" id="diciembre" value="<?php echo $diciembre ?>">
      
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Estadisticas Solicitudes</div>
        <div class="card-body">
          <canvas id="myBarChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-envelope"></i> Solicitudes</div>
            <div class="list-group list-group-flush small">
              <?php 
              $querysolic = $conexion->query("SELECT * FROM logsolic ORDER BY fecha desc LIMIT 5");

              while ($logsolic = $querysolic->fetch_assoc()) {
                $idsolic = $logsolic['idsolic'];

                $query4 = $conexion->query("SELECT solicitud,nombre,correo FROM solicitud WHERE id='$idsolic'");
                $datosolic = $query4->fetch_assoc();

                if ($query4) {
                  ?>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <div class="media-body">
                        <strong><?php echo $datosolic['nombre'] ?></strong> Ha enviado una solicitud: 
                        <strong><?php echo $datosolic['solicitud'] ?></strong>.
                        <div class="text-muted smaller"><?php echo $datosolic['correo']." | ".$logsolic['fecha'] ?></div>
                      </div>
                    </div>
                  </a>
                  <?php
                }
              }

              $queryfechsolic = $conexion->query("SELECT fecha FROM logsolic ORDER BY fecha desc LIMIT 1");
              $resultfechsolic = $queryfechsolic->fetch_assoc();

              ?>
              <a class="list-group-item list-group-item-action" href="trabajos.php"><center><b>Ver Todas las Solicitudes  </b></center></a>
            </div>
            <div class="card-footer small text-muted">Ultima Solicitud Recibida: <?php echo $resultfechsolic['fecha'] ?></div>
          </div>
          <!-- /Card Columns-->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <!-- Example Notifications Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-user"></i> Usuarios</div>
            <div class="list-group list-group-flush small">
              <?php 
              $querysesion = $conexion->query("SELECT * FROM loguser ORDER BY fecha desc LIMIT 5");

              while ($log = $querysesion->fetch_assoc()) {
                $iduser = $log['iduser'];

                $query3 = $conexion->query("SELECT usuario FROM usuario WHERE id='$iduser'");
                $datosuser = $query3->fetch_assoc();

                if ($query3) {
                  ?>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <div class="media-body">
                        <strong><?php echo $datosuser['usuario'] ?></strong>
                        Ha iniciado sesión
                        <div class="text-muted smaller"><?php echo $log['fecha'] ?></div>
                      </div>
                    </div>
                  </a>
                  <?php
                }
              }

              $queryultimafecha = $conexion->query("SELECT fecha FROM loguser ORDER BY fecha desc LIMIT 1");
              $resultultimafecha = $queryultimafecha->fetch_assoc();
              $ultimafecha = $resultultimafecha['fecha'];

              ?>
              <a class="list-group-item list-group-item-action" href="sesion.php"><center><b>Ver todo</b></center></a>
            </div>
            <div class="card-footer small text-muted">Ultimo inicio de sesión: <?php echo $ultimafecha ?></div>
          </div>
        </div>
        <div class="col-lg-7">
          <!-- Example Notifications Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-check-circle"></i> Revisiones</div>
            <div class="list-group list-group-flush small">
              <?php 
              $queryrevisar = $conexion->query("SELECT * FROM logrevisar ORDER BY fecha desc LIMIT 5");

              while ($revisar = $queryrevisar->fetch_assoc()) {
                $iduserr = $revisar['iduser'];
                $idsolicr = $revisar['idsolic'];

                $datosuserr = ($conexion->query("SELECT usuario FROM usuario WHERE id='$iduserr'"))->fetch_assoc();
                $datossolicr = ($conexion->query("SELECT nombre,solicitud FROM solicitud WHERE id='$idsolicr'"))->fetch_assoc();

                if ($query3) {
                  ?>
                  <a class="list-group-item list-group-item-action" href="#">
                    <div class="media">
                      <div class="media-body">
                        <strong><?php echo $datosuserr['usuario'] ?> </strong>
                        <?php echo $revisar['accion']?> de: <strong><?php echo $datossolicr['nombre']."[".$datossolicr['solicitud']."]" ?></strong>
                        <div class="text-muted smaller"><?php echo $revisar['fecha'] ?></div>
                      </div>
                    </div>
                  </a>
                  <?php
                }
              }

              $queryultimafechar = $conexion->query("SELECT fecha FROM logrevisar ORDER BY fecha desc LIMIT 1");
              $resultultimafechar = $queryultimafechar->fetch_assoc();
              $ultimafechar = $resultultimafechar['fecha'];

              ?>
              <a class="list-group-item list-group-item-action" href="trabajos.php"><center><b>Ver todo</b></center></a>
            </div>
            <div class="card-footer small text-muted">Ultimo cambio: <?php echo $ultimafechar ?></div>
          </div>
        </div>
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
    <!-- Perfil Modal-->
    <div class="modal fade" id="modalperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Perfil de Usuario</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="formdatos">
              <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese Nombre" value="<?php echo $user['usuario'] ?>">
              </div>
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre" value="<?php echo $user['nombre']; ?>">
              </div>
              <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellido" value="<?php echo $user['apellido']; ?>">
              </div>
              <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese Correo Electronico" value="<?php echo $user['correo']; ?>">
              </div>

              <center><div id="actualizarperfil"></div></center>

              <div class="form-group">
                <center>
                  <button type="button" class="btn btn-success" id="btnformdatos" name="btnformdatos" onclick="actualizardatos()">Actualizar</button>
                </center>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Cambiar Contraseña Modal-->
    <div class="modal fade" id="modalcontra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="formcontra">
              <div class="form-group">
                <label for="actual">Contraseña Actual:</label>
                <input type="password" class="form-control" name="actual" id="actual" placeholder="Ingrese Contraseña Actual">
              </div>
              <div class="form-group">
                <label for="nueva">Nueva Contraseña:</label>
                <input type="password" class="form-control" name="nueva" id="nueva" placeholder="Ingrese Nueva Contraseña">
              </div>
              <div class="form-group">
                <label for="repetir">Repita Contraseña:</label>
                <input type="password" class="form-control" name="repetir" id="repetir" placeholder="Repetir Nueva Contraseña">
              </div>

              <center><div id="cambiarcontrase"></div></center>

              <div class="form-group">
                <center>
                  <button type="submit" class="btn btn-success" id="btncontra" name="btncontra">Cambiar Contraseña</button>
                </center>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script src="js/chart.js"></script>

    <!-- SCRIPT ACTUALIZAR DATOS-->
    <script>
      function actualizardatos(){
        //$('#loadingregister').removeClass('hidden');
        event.preventDefault(); //Con esto no deja recargar
        var nombre = document.getElementById("nombre").value;
        var apellido = document.getElementById("apellido").value;
        var correo = document.getElementById("correo").value;
        var usuario = document.getElementById("usuario").value;
        
        var datos = 'nombre='+nombre;
        datos += '&apellido='+apellido;
        datos += '&correo='+correo;
        datos += '&usuario='+usuario;
        datos += '&pag=1';

        $.ajax({
            type: "POST",
            url: "ajax/guardarperfil.php",
            data: datos,
            dataType:"html",
            asycn:false,
            success: function(){
              console.log('Datos enviados - Actualizar perfil');
              //$('#loadingregister').addClass('hidden');
            }
        })
        .done(function(respuesta2){
            console.log('Consulta realizada - Actualizar perfil');
            $("#actualizarperfil").html(respuesta2);
        })
        .fail(function(respuesta2){
            console.log('Error petición ajax - Actualizar perfil');
        })         
      }
    </script> 

    <!-- SCRIPT CAMBIAR CONTRA-->
    <script>
      $(document).ready(function(){
        $('#formcontra').submit(function(){
          //$('#loadingregister').removeClass('hidden');
          event.preventDefault(); //Con esto no deja recargar
          var actual = document.getElementById("actual").value;
          var nueva = document.getElementById("nueva").value;
          var repetir = document.getElementById("repetir").value;
          
          var datos = 'actual='+actual;
          datos += '&nueva='+nueva;
          datos += '&repetir='+repetir;
          datos += '&pag=1';

          $.ajax({
              type: "POST",
              url: "ajax/cambiarcontra.php",
              data: datos,
              dataType:"html",
              asycn:false,
              success: function(){
                console.log('Datos enviados - Cambiar contraseña');
                //$('#loadingregister').addClass('hidden');
              }
          })
          .done(function(respuesta2){
              console.log('Consulta realizada - Cambiar contraseña');
              $("#cambiarcontrase").html(respuesta2);
          })
          .fail(function(respuesta2){
              console.log('Error petición ajax - Cambiar contraseña');
          }) 
        });
      });
    </script> 

  </div>
</body>

</html>
