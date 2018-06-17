<?php

include('header.php');
if ($verificar->esta_logueado()){ 

$id= $verificar->id();


$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$id ";
$resultado= mysqli_query($link,$sql);
$mostrar = mysqli_fetch_array($resultado);

 ?>


<div class="conteiner-form " >
<h1 class="h1-form">Editar mi Perfil</h1>

<div class="conteiner-f1">
<form id="form" action="validar_modificar_user.php" method="POST">
	<?php if (isset($_SESSION['mensaje']) ){ ?>
				<div class="error_sql">
				<p class="p_msj_error"><span class="icon-warning"></span> <?php echo $_SESSION['mensaje'];?> </p>
			</div>
	<?php unset($_SESSION['mensaje']); }?>
	<!--  - - - - - - - - - -  - - - - - - - -  -->
	<div>
		<label for="email"> Email:</label>
		<br>
		<input id="email" class="input-f1 no_cursor" type="email" name="" value="<?php echo($mostrar['email']);?>" disabled>
		<p class="msj_f1_email">Recuerde, la contraseña no se puede modificar</p>
	</div>
<!--  - - - - - - - - - -  - - - - - - - -  -->
	<div>
		<label for="nombre" > Nombre:</label><span id="error_nombre" class="error"></span>
		<br>
	<input id="nombre" class="input-f1 focus_azul "type="text" name="nombre" value="<?php echo($mostrar['nombre']);?>">
	</div>
	<!--  - - - - - - - - - -  - - - - - - - -  -->
	<div>
		<label for="apellido"> Apellido:</label>
		<span id="error_apellido" class="error"> </span>
		<br>
		<input id="apellido" class="input-f1 focus_azul " type="text" name="apellido" value="<?php echo($mostrar['apellido']);?>">
	</div>

	<div>
		<label for="fecha_nac"> Fecha nacimiento</label>
		<span id="error_fecha" class="error"></span>
		<br>
		<input id="fecha_nac" class="input-f1 focus_azul" type="date" name="fecha_nac" value="<?php echo($mostrar['fecha_nac']);?>">
	</div>

	<div>
	<label for="password"> Contraseña</label>
	<span id="error_password" class="error"></span>
	<br>
	<input id="password" class="input-f1 focus_azul" type="password" name="pass1" value="<?php echo($mostrar['password']);?>">
	</div>

	<div>
	<label for="password2"> Repetir contraseña</label>
	<span id="error_password" class="error"></span>
	<br>
	<input  id="password2" class="input-f1 focus_azul" type="password" name="pass2" value="<?php echo($mostrar['password']);?>">
	<span id="error_password2"></span>
	</div>
	<button class="btn-mod fondo-blue" type="submit">Guardar</button>
	<a class=" btn-mod fondo-blue btn-volver" href="mi_perfil.php"> <span class="icon-arrow-left"></span> Volver</a>

</form>

</div>
</div>
<?php }else{
	header("Location:index.php");
}
include('footer.php');
?>
<script type="text/javascript" src="js/validar_modificacion_usuario.js"></script>
</body>
</html>
