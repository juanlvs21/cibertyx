<!DOCTYPE html>
<html lang="es">

<head>
</head>

<body>
	<form method="POST">
		<label for="contra">Contraseña</label>
		<input type="" name="contra" id="contra">
		<button type="submit" name="btn">Generar</button>
	</form>
	<?php
		if (isset($_POST['btn'])) {
			$contra = md5($_POST['contra']);
		}
		?>
			<h3>Su contraseña es:</h3>
		<?php
		echo $contra;

		$fecha = date('ymd');
		$user = substr(strtoupper(md5(microtime(true))),0,10);
		$pass = substr(md5(microtime(false)),0,15);

	?>
	<br><br><br><br>
	<p>Fecha: <?php echo $fecha ?></p>
	<br>
	<p>Usuario: <?php echo $user ?></p>
	<br>
	<p>Pass: <?php echo $pass ?></p>
</body>

</html>