<?php include('header.php'); 

$verificar = new validar($link);//se crea  una clase
				
if (!$verificar->esta_logueado()){
?>


<div class="container " style="width: 75%" >
	<h1 class="h1-form">Login

	</h1>

<div class="conteiner-f1">
	<form class="conteiner" id="form_sesion" action="validar_sesion.php" method="POST"style="margin-bottom: -3%" >
		<br>

		<?php if (isset($_SESSION['mensaje']) ){ ?>
				<div class="error_sql">
				<p class="p_msj_error"><span class="icon-warning"></span> <?php echo $_SESSION['mensaje'];?> </p>
			</div>
		<?php unset($_SESSION['mensaje']); }?>		
		<div>
			<label for="email">Email:</label>
			<span id="error_email" class="error"></span>
			<br>
			<input type="email" id="email" class="input-f1 focus_azul " name="email">
			<br>
		</div>
	
		<div>
			<br>
			<label for="password">Contraseña:</label><span id="error_password" class="error"></span>
			<br>
			<input type="password" id="password" class="input-f1 focus_azul " name="password">
			<span>¿Has olvidado tu contraseña?click</span>
			<a href="recuperar_clave.php"> AQUÍ</a>
		</div>
		
		<button  class="input-f1 text-white fondo-blue btn-form" type="submit">Iniciar sesion</button>
		<p style="text-align: center;">¿Usted no posee una cuenta? click <a href="registrarse.php" class="color-a">AQUÍ</a></p>
		
	</form>
</div>
</div>
<?php }else{
	header("Location:inicio.php");
} ?>

<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_iniciar_sesion.js"></script>
</body>
</html>