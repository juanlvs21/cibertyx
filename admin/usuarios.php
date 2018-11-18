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

    if ($user['admin'] == '0') {
      ?>
      <script type="text/javascript">
        alert('Prohibido - Debes ser Administrador');
        location.href = 'index.php'
      </script>
      <?php
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CIBERTYX | Usuarios</title>
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
          <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Usuario">
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
        <li class="breadcrumb-item active"><a href="usuarios.php">Usuarios</a></li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Lista de Usuarios
          <button class="btn btn-primary btn-sm" style="float: right; margin-left: 5px;" title="Nuevo Usuario" data-toggle="modal" data-target="#modalnuevo" onclick="generar()">Nuevo</button>
        </div>
        <div class="card-body">
          <center>
            <img src="../img/loading.gif" style="height: 60px; width: auto" class="hidden" id="loadingtabla">
          </center>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>Admin</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>Admin</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody id="resulttabla"> 
                <?php
                  $query = $conexion->query("SELECT * FROM usuario");

                  while ($usuarios = $query->fetch_assoc()) {
                    $iduser = $usuarios['id'];
                    $usuario = $usuarios['usuario'];
                    $nombre = $usuarios['nombre'];
                    $apellido = $usuarios['apellido'];
                    $correo = $usuarios['correo'];
                    $admin = $usuarios['admin'];
                    ?>

                    <tr>
                      <td><?php echo $usuario ?></td>
                      <td>
                        <?php echo $nombre." ".$apellido ?>
                      </td>
                      <td><?php echo $correo ?></td>
                      <td>
                        <script>
                          function admin(id,estado,tipo){
                                $('#loadingtabla').removeClass('hidden');

                                var datos = "id="+id;

                                $.ajax({
                                  type: "POST",
                                      url: "ajax/admin.php",
                                      data: datos,
                                      dataType:"html",
                                      asycn:false,
                                      success: function(){
                                        console.log('Datos enviados - Cambiar Admin/User ');
                                        $('#loadingtabla').addClass('hidden');
                                      }
                                })
                                .done(function(respuesta){
                                  console.log('Consulta realizada - Cambiar Admin/User ');
                                  $("#respuestaajax").html(respuesta);
                                })
                                .fail(function(respuesta){
                                  console.log('Error petición ajax - Cambiar Admin/User ');
                                })
                          }                         
                        </script>  
                        <center>
                          <?php 
                          if ($admin == '1') {
                            ?>
                            <i class="fa fa-check" style="color: green"></i>
                            <?php
                          }else{
                            ?>
                            <i class="fa fa-remove" style="color: red"></i>
                            <?php
                          }
                          ?>
                        </center>
                      </td>
                      <div id="respuestaajax"></div>
                      <td>
                        <center>
                          <button class="btn btn-info btn-sm"  onclick="admin('<?php echo $iduser ?>')">Admin/User</button>
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
        <div class="card-footer small text-muted">Lista de Usuarios</div>
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

    <!-- Nuevo Modal-->
    <div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="form-group">
                <label for="correof">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correof" id="correof" required>
              </div>
              <center>
                <button type="submit" class="btn btn-success" id="btncrear" name="btncrear">Crear</button>
              </center>
            </form>
            <?php 
            if (isset($_POST['btncrear'])) {
             $destino = mysqli_real_escape_string($conexion, $_POST['correof']);
             $asunto = "CIBERTYX - Creación de cuenta de Administrador";

             $useralea = substr(strtoupper(md5(microtime(true))),0,10);
             $passalea = substr(md5(microtime(false)),0,15);

             $carta  = "De: CIBERTYX - www.cibertyx.com.ve \n \n";
             $carta .= "¡SALUDOS!, Usted ha sido añadido a los desarrolladores de CIBERTYX. \n\n";
             $carta .= "Usuario Inicial: $useralea \n";
             $carta .= "Contraseña Inicial: $passalea \n\n";
             $carta .= "Panel de Administrador: www.cibertyx.com.ve/admin \n\n";
             $carta .= "(Se recomienda cambiar estos datos luego de iniciar sesión) \n\n\n";
             $carta .= "------------- Copyright © CIBERTYX 2018 -------------";

             //Enviando Mensaje
             mail($destino, $asunto, $carta);

             if ($_POST) {
               ?>
               <script type="text/javascript">
                 alert('Usuario Creado Exitosamente')
               </script>
               <?php
             }

             ?>
             <script type="text/javascript">
               location.href = 'usuarios.php';
             </script>
             <?php
            }
            ?>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
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
        datos += '&pag=4';

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
          datos += '&pag=4';

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
