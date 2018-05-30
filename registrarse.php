<?php include('header.php');
$verificar = new validar($link);//se crea  una clase
				
if (!$verificar->esta_logueado()){
 ?>


<div class="conteiner-form">
	<h1 class="h1-form">Registrarse</h1>

<div class="conteiner-f1" >
	<form  id="f1_registro" class="conteiner" action="validar_registro.php" method="POST">

		<?php if (isset($_SESSION['mensaje']) ){ ?>
				<div class="error_sql">
				<p class="p_msj_error"><span class="icon-warning"></span> <?php echo $_SESSION['mensaje'];?> </p>
			</div>
		<?php unset($_SESSION['mensaje']); }?>
	
		<div>
			<br>
			<label for="nombre" class="">Nombre:</label>
			<span id="error_nombre" class="error"></span>
			<br>
			<input type="text" id="nombre" class="input-f1 focus_azul " name="nombre">
			<br>
		</div>
	
		<div>
			<br>
			<label for="apellido" class="">Apellido:</label>
			<span id="error_apellido" class="error"></span>
			<br>
			<input type="text" id="apellido" class="input-f1 focus_azul" name="apellido">
			<br>
		</div>
		<div>
			<br>
			<label for="email" class="">Email:</label>
			<span id="error_email" class="error"></span>
			<br>
			<input type="email" id="email" class="input-f1 focus_azul" name="email">
			<br>
		</div>
	
		<div>
			<br>
			<label for="fecha_nac" class="">Fecha nacimiento:</label>
			<span id="error_fecha_nac" class="error"></span>
			<br>
			<input type="date" id="fecha_nac" class="input-f1 focus_azul" name="fecha_nac">
			<br>
		</div>
	
		<div>
			<br>
			<label for="password" class=" focus_azul">Contraseña:</label><span id="error_password" class="error"></span>
			<br>
			<input type="password" id="password" class="input-f1 focus_azul" name="pass1">
			<br>
		</div>

		<div>
			<br>
			<label for="password2" class="">Repetir contraseña:</label><span id="error_password2" class="error"></span>
			<br>
	<input type="password" id="password2" class="input-f1  focus_azul " name="pass2">
			<br>
		</div>
		<br>
		<button  class="input-f1 text-white fondo-blue btn-form" type="submit">Enviar</button>
		<p>¿Usted ya posee una cuenta? click <a href="index.php">AQUÍ</a></p>
	</form>
</div>
</div>
<?php }else{
	header("Location:inicio.php");
} ?>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_registro.js"></script>

</body>
</html>