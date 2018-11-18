<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>CIBERTYX | Contacto</title> <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/theme.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<style type="text/css">
  .hidden{
    display: none;
  }
</style>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top top-nav-collapse" role="navigation">
	<div class="container" style="color: black">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
			<i class="fa fa-bars" style="color: white"></i>
			</button>
			<a class="navbar-brand page-scroll" href="/cibertyx" style="color: white">
			CIBERTYX </a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
			<ul class="nav navbar-nav" style="color: white">
				<li>
				<a href="/cibertyx">Inicio</a>
				</li>
				<li>
				<a href="/cibertyx/trabajos">Trabajos</a>
				</li>
				<li class="active">
				<a href="/cibertyx/contacto">Contacto</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
<!-- /.container -->
</nav>
<!-- Intro Header -->
<header class="">
</header>


<!-- Contact Section -->
<section id="contact">
<div class="container content-section">
		<div class="row">
			<br>
			<center>
				<h2>
					CONTÁCTANOS
					<div class="linea"></div>
					<small id="maquinaescribir2">.</small>
				</h2>
			</center>
		<div class="col-md-6">
			<center><img src="img/pantalla.png"></center>
		</div>
		<div class="col-md-6">
			<div class="col-lg-offset-1 col-sm-10 col-sm-offset-1">
				<div id="solicitudenviada"></div>
				<form method="post" id="contactform">
					<div class="form">
						<input type="text" class="" name="nombre" id="nombre" placeholder="Ingrese su Nombre" required="">
						<input type="email" class="" name="correo" id="correo" placeholder="Ingrese su Correo Electrónico" required="">
						<!--label for="option" style="color: #504e4e;">TIPO DE  TRABAJO: *</label-->
						<br><br>
						<select class="" name="solicitud" id="solicitud" required="">
							<option value="Blog Personal">Blog Personal</option>
							<option value="Web Empresarial">Web Empresarial</option>
							<option value="Galeria Fotográfica">Galeria Fotográfica</option>
							<option value="Tinda Online">Tinda Online</option>
						</select>			
						<textarea  name="descripcion" class="" id="descripcion" rows="7" placeholder="Describa su Solicitud" required=""></textarea>
						<input type="submit" id="submit" name="submit" class="clearfix btn" onclick="contactar()" value="Enviar Solicitud"> 
					</div>
				</form>
			</div>			
		</div>
		<center>
			<h2>
				<small id="maquinaescribir">.</small>
			</h2>
		</center>
	</div>
</div>
</section>

<!-- Footer -->
<footer>
<div class="container text-center">
	<p class="credits">
		Copyright &copy; Cibertyx 2018<br/>
	</p>
</div>
</footer>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<!-- SCRIPT ENVIAR SOLICITUD-->
<script>
  function contactar(){
    //$('#loadingregister').removeClass('hidden');
    var nombre = document.getElementById("nombre").value;
    var correo = document.getElementById("correo").value;
    var solicitud = document.getElementById("solicitud").value;
    var descripcion = document.getElementById("descripcion").value;
    
    var datos = 'nombre='+nombre;
    datos += '&correo='+correo;
    datos += '&solicitud='+solicitud;
    datos += '&descripcion='+descripcion;

    $.ajax({
        type: "POST",
        url: "ajax/contactar.php",
        data: datos,
        dataType:"html",
        asycn:false,
        success: function(){
          console.log('Datos enviados - Enviar Solicitud');
          //$('#loadingregister').addClass('hidden');
        }
    })
    .done(function(respuesta2){
        console.log('Consulta realizada - Enviar Solicitud');
        $("#solicitudenviada").html(respuesta2);
    })
    .fail(function(respuesta2){
        console.log('Error petición ajax - Enviar Solicitud');
    }) 

    event.preventDefault(); //Con esto no deja recargar        
  }
</script> 
<!-- Maquina Escribir JavaScript-->
<script type="text/javascript">
	let writing = str => {
		let arrFromStr = str.split('');
		let i = 0;

		let printStr = setInterval(function(){

			if (i === 0) {
				document.getElementById('maquinaescribir').innerHTML = arrFromStr[i];				
			}else{
				document.getElementById('maquinaescribir').innerHTML += arrFromStr[i];
			}

			i++;

			if (i === arrFromStr.length) {
				clearInterval(printStr);
			}
		},200);		
	}

	let writing2 = str => {
		let arrFromStr = str.split('');
		let i = 0;

		let printStr = setInterval(function(){

			if (i === 0) {
				document.getElementById('maquinaescribir2').innerHTML = arrFromStr[i];				
			}else{
				document.getElementById('maquinaescribir2').innerHTML += arrFromStr[i];
			}

			i++;

			if (i === arrFromStr.length) {
				clearInterval(printStr);
			}
		},200);		
	}

	writing('DISEÑAMOS TU PÁGINA WEB PROFESIONAL...');

	setInterval(function(){
		writing('DISEÑAMOS TU PÁGINA WEB PROFESIONAL...');
		document.getElementById('maquinaescribir').innerHTML = ".";
	},8500);

	writing2('ESTAMOS DISPUESTOS PARA AYUDARTE...');
	setInterval(function(){
		writing2('ESTAMOS DISPUESTOS PARA AYUDARTE...');
		document.getElementById('maquinaescribir2').innerHTML = ".";
	},8500);
</script>

</body>
</html>