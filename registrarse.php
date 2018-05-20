<?php include('header.php'); ?>

<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje']; ?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form">
	<h1 class="h1-form">Registrarse</h1>

<div class="conteiner-f1" >
	<form class="conteiner" action="validar_registro.php" method="POST">
	
		<div>
			<label for="nombre" class="label-f1">Nombre:</label>
			<input type="text" id="nombre" class="input-f1" name="nombre">
		</div>
	
		<div>
			<label for="apellido" class="label-f1">Apellio:</label>
			<input type="text" id="apellido" class="input-f1" name="apellido">
		</div>
		<div>
			<label for="email" class="label-f1">Email:</label>
			<input type="email" id="email" class="input-f1" name="email">
		</div>
	
		<div>
			<label for="fecha_nac" class="label-f1">Fecha nacimiento:</label>
			<input type="date" id="fecha_nac" class="input-f1" name="fecha_nac">
		</div>
	
		<div>

			<label for="password" class="label-f1">Contraseña:</label>
			<input type="password" id="password" class="input-f1" name="pass1">
		</div>

		<div>
			<label for="password2" class="label-f1">Repetir contraseña:</label>
			<input type="password" id="password2" class="input-f1" name="pass2">
		</div>

		<p>Usted ya posee una cuenta click <a href="index.php"> AQUÍ</a></p>
		<button type="submit">Enviar</button>
	</form>
</div>
</div>

<?php //include('footer.php'); ?>

</body>
</html>