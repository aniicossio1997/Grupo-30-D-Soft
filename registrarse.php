<?php include('header.php'); ?>

<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje']; ?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form">
	<h1 class="h1-form">Registrarse</h1>

<div class="conteiner-f1" >
	<form class="conteiner" id="registro" action="validar_registro.php" method="POST">
	
		<div>
			<br>
			<label for="nombre" class="label-f1">Nombre:</label><span class="error" id="error_nombre"></span>
			<input type="text" id="nombre" class="input-f1" name="nombre">
		</div>
	
		<div>
			<br>
			<label for="apellido" >Apellido:</label><span class="error" id="error_apellido"></span>
			<input type="text" id="apellido" class="input-f1" name="apellido">
		</div>
		<div>
			<br>
			<label for="email" >Email:</label><span class="error" id="error_email"></span>
			<input type="text" id="email" class="input-f1" name="email">
		</div>
	
		<div>
			<br>
			<label for="fecha_nac">Fecha nacimiento:</label><span class="error" id="error_fecha_nac"></span>
			<input type="date" id="fecha_nac" class="input-f1" name="fecha_nac">
		</div>
	
		<div>
			<br>
			<label for="password" >Contraseña:</label><span class="error" id="error_password"></span>
			<input type="password" id="password" class="input-f1" name="pass1">
		</div>

		<div>
			<br>
			<label for="password2">Repetir contraseña:</label><span class="error" id="error_password2"></span>
			<input type="password" id="password2" class="input-f1" name="pass2">
		</div>

		<button  class="input-f1 text-white fondo-blue btn-form" type="submit">Enviar</button>
		<p>¿Usted ya posee una cuenta? click <a href="index.php">AQUÍ</a></p>
	</form>
</div>
</div>

<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_registro.js"></script>
</body>
</html>