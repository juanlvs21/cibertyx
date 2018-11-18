<?php
    include("../config/conexion.php");

    session_start();

    if(isset($_SESSION['id'])){
      header('Location: index.php');

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
  <title>CIBERTYX | Iniciar Sesión</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<style type="text/css">
  body{
    background: url('../img/login.jpeg');
    background-repeat: no-repeat; /*Para que el fondo no se repita*/
    background-size: cover; /*Esta propiedad hace que la imagen se ajuste a la pantalla*/
  }

  .hidden{
    display: none;
  }

  .btn-default {
    border:1px solid  white;
    color: white;
    background-color: #038ae8;
    border-radius: 20px;
  }
  .btn-default:hover,.btn-default:focus {
    border:1px solid #42dca3;
    outline:0;
    color:#000;
    background-color:#76c1f6;
  }

  .titulo-sesion{
    margin-top: 10%;
  }

  .linea{
    border-top: 2px solid black;
    width: 30%;
    margin-bottom: 10%;
  }

  #particles-js{
    width: 100%;
    height: 100%;
    position: absolute;
  }
  .form-control{
    border-radius: 20px;
  }
</style>

<body>
  <div id="particles-js"></div>

  <br><br><br><br>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-body">
        <center>
          <h3 class="titulo-sesion">Iniciar Sesión</h3>
          <div class="linea"></div>
        </center>
        <form method="POST" id="formlogin">
          <div class="form-group">
            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Nombre de Usuario">
          </div>
          <div class="form-group">
            <input class="form-control" id="contra" name="contra" type="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <!--div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div-->
          </div>
          <center>
            <img src="../img/loading.gif" class="hidden" id="loadingregister" style="height: 60px; width: auto; margin-bottom: 10px">
            <br>
            <button type="submit" class="btn btn-default" name="btnsesion" id="btnsesion">Iniciar Sesión</button>
          </center>
        </form>

        <center>
          <div id="register"></div>
        </center>

        <div class="text-center">
          <br>
          <!--a class="d-block small mt-3" href="register.html">Register an Account</a-->
          <a class="d-block small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Particles JavaScript-->
  <script src="../js/particles.js"></script>
  <!-- Particulas JavaScript-->
  <script src="../js/particulas.js"></script>
  <!-- LOGIN JavaScript-->
  <script>
    $(document).ready(function(){
      $('#formlogin').submit(function(){
        var usuario = document.getElementById('usuario').value;
        var contra = document.getElementById('contra').value;

        if ((usuario != "")&&(contra != "")) {
          $('#loadingregister').removeClass('hidden');
          
          var datos = 'usuario='+usuario;
          datos += '&contra='+contra;

          $.ajax({
              type: "POST",
              url: "ajax/login.php",
              data: datos,
              dataType:"html",
              asycn:false,
              success: function(){
                console.log('Datos enviados - Iniciar sesión');
              }
          })
          .done(function(respuesta2){
              console.log('Consulta realizada - Iniciar sesión');
              $("#register").html(respuesta2);
          })
          .fail(function(respuesta2){
              console.log('Error petición ajax - Iniciar sesión');
          })          
        }else{
          console.log('Error campos vacicos - Iniciar sesión');
          alert("Error - Uno de los campos se encuentra vacios");
        }; 
        event.preventDefault();
      });
    });
  </script>  
</body>

</html>
