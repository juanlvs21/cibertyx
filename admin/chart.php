<!DOCTYPE html>
<html>
<head>
	<title>Probando Chart.js</title>
	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--script type="text/javascript">
		$(document).ready(function(){
			var datos = {
				type : "pie",
				data : {
					datasets : [{
						data : [
							5,
							10,
							40,
							12,
							23,
						],
						backgroundColor: [
							"#F7464A",
							"#46BFBD",
							"#FDB45C",
							"#949FB1",
							"#405360",
						],
					}],
					labels : [
						"Datos 1",
						"Datos 2",
						"Datos 3",
						"Datos 4",
						"Datos 5",
					]
				},
				options : {
					responsive : true,
				}
			};

			var canvas = document.getElementById('chart').getContext('2d');
			window.pie = new Chart(canvas, datos);

		});
	</script-->
</head>
<body>
	<!--div id="canvas-container" style="width: 50%">
		<canvas id="chart" width="500" height="350"></canvas>
	</div-->

    <?php 
    include("../config/conexion.php");

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

    <div class="col-lg-8">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> Estadisticas de Solicitudes <?php echo $year ?>
        </div>
        <div class="card-body">
          <canvas id="myBarChart" width="100" height="50"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="vendor/chart.js/Chart.js"></script>
	<script type="text/javascript" src="js/Chart.js"></script>
</body>
</html>


