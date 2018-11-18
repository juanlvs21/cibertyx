<?php
    include("config/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>CIBERTYX | Trabajos</title> <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/theme.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

<link href="css/maquinaescribir.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
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
				<li class="active">
				<a href="/cibertyx/trabajos">Trabajos</a>
				</li>
				<li>
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

<!-- Services Section -->
<section id="services">
	<br><br><br><br><br><br><br>
	<center>
		<h2>
			NUESTROS TRABAJOS
			<div class="linea"></div>
		</h2>
	</center>
	<!-- Imagenes 400x430 -->
	<br>
	<div class="row">
	    <div class="container">
	        <div class="team-top">
	            <?php 
	            $query = $conexion->query("SELECT nombreproyecto,url,img FROM solicitud WHERE terminada='1'");

	            while ($trabajo = $query->fetch_assoc()) {
	            	$url = $trabajo['url'];
	            	$nombre = $trabajo['nombreproyecto'];
	            	$img = $trabajo['img'];
	            	?>
	           		<!-- Tarjeta -->
		            <div class="col-md-3 col-sm-3 col-xs-12">
			            <div class="single-team-member">
			                <div class="team-img">
			                	<a href="#">
									<img src="img/trabajos/<?php echo $img ?>" alt="">
								</a>
			                	<div class="team-social-icon text-center">
			                    	<ul>
			                    		<li>
			                       			<a href="<?php echo 'http://'.$url ?>" target="_blank" style="border-radius: 15px">Visitar</a>
			                    		</li>
			                  		</ul>
			                	</div>
			              	</div>
			              	<div class="team-content text-center">
			                	<h4><?php echo $nombre ?></h4>
			              	</div>
			            </div>
		            </div>
		            <!-- Fin Tarjeta -->
	            	<?php
	            }
	            ?>
	        </div>
	    </div>		
	</div>
	<br><br><br><br><br><br><br>
</section>

<!-- Contact -->
<section>
	<div class="cinta-contact" style="background-image: url('img/contacto.jpg'); background-repeat: no-repeat;background-size: cover;">
		<!--div class="particula animacionParticula"></div-->
		<div class="cinta-contact-text" style="color: white">
			<h2>
				<br><br>
				<i id="maquinaescribir"></i>
				<br>
				<small style="color: white">Piensa más, Diseña menos...</small>
				<br><br>
				<a class="btn btn-danger" href="/cibertyx/contacto" style="color: white; border-radius: 5px">CONTÁCTANOS</a>
			</h2>
		</div>
	</div>
	<br>
</section>
<!-- Contact -->

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
<!-- Maquina Escribir JavaScript-->
<script type="text/javascript">
	let writing = str => {
		let arrFromStr = str.split('');
		let i = 0;

		let printStr = setInterval(function(){

			document.getElementById('maquinaescribir').innerHTML += arrFromStr[i];
			i++;

			if (i === arrFromStr.length) {
				clearInterval(printStr);
			}
		},200);		
	}

	writing('DISEÑAMOS TU PÁGINA WEB PROFESIONAL...');

	setInterval(function(){
		writing('DISEÑAMOS TU PÁGINA WEB PROFESIONAL...');
		document.getElementById('maquinaescribir').innerHTML = "";
	},8500);
</script>
</body>
</html>