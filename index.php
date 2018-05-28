<?php include('header.php'); ?>



<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje'];?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form " >
	<h1 class="h1-form">Iniciar Sesión</h1>

<div class="conteiner-f1">
	<form class="conteiner" name="form_inciar" action="validar_sesion.php" method="POST" id="form">
	
		<div>
			<br>
			<label for="email" >Email:</label><span class="error" id="error_email"></span>
			<input type="email" id="email" class="input-f1" name="email" >
		</div>
	
		<div>
			<br>
			<label for="password">Contraseña:</label><span class="error" id="error_password"></span>
			<input type="password" id="password" class="input-f1" name="password" >
		</div>
		
		<button  class="input-f1 text-white fondo-blue btn-form" type="submit">Enviar</button>
		<p>¿Usted no posee una cuenta? click <a href="registrarse.php">AQUÍ</a></p>
	</form>
</div>
</div>


<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_iniciar_sesion.js"></script>
</body>
</html>