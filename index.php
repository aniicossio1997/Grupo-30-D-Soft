<?php include('header.php'); ?>



<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje'];?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form " >
	<h1 class="h1-form">Iniciar Sessión</h1>

<div class="conteiner-f1">
	<form class="conteiner" action="validar_sesion.php" method="POST">
	
		<div>
			<label for="email" class="label-f1">Email:</label>
			<input type="email" id="email" class="input-f1" name="email" required="">
		</div>
	
		<div>
			<label for="password" class="label-f1">Contraseña:</label>
			<input type="password" id="password" class="input-f1" name="password" required="">
		</div>
		<p>Usted no posee una cuenta click <a href="registrarse.php">AQUÍ</a></p>
		<button type="submit">Enviar</button>
	</form>
</div>
</div>


<?php include('footer.php'); ?>

</body>
</html>