<?php include('header.php'); 

if ($verificar->esta_logueado()){
	header("Location:inicio.php");
}

?>


<div class="container " style="width: 75%" >
	<h1 class="h1-form">Recuperar contraseña

	</h1>

<div class="conteiner-f1">
	<form class="conteiner" id="form_rec" action="validar_recuperacion.php" method="POST" style="margin-bottom: -3%" >

		<?php if (isset($_SESSION['mensaje']) ){ ?>
				<div class="error_sql">
				<p class="p_msj_error"><span class="icon-warning"></span> <?php echo $_SESSION['mensaje'];?> </p>
			</div>
		<?php unset($_SESSION['mensaje']); }?>		
		<div style="margin-top: 2%">
			<label for="email">Email:</label>
			<span id="error_email" class="error"></span>
			<br>
			<input type="email" id="email" class="input-f1 focus_azul " name="email" placeholder="escriba un correo para continuar">
			<br>
		</div>
		<br>
		<button  class="btn btn-success" type="submit">Continuar</button>
		<p style="text-align: center;">¿Usted no posee una cuenta? click <a href="registrarse.php" class="color-a">AQUÍ</a></p>
		
	</form>
</div>
</div>



<?php 

include('footer.php');
 ?>
 <script type="text/javascript" src="js/validar_recuperacion.js"></script>

</body>
</html>