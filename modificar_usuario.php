<?php

include('header.php');
if ($verificar->esta_logueado()){ 

$id= $verificar->id();


$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$id ";
$resultado= mysqli_query($link,$sql);
$mostrar = mysqli_fetch_array($resultado);

 ?>

<?php if (isset($_SESSION['mensaje']) ){ ?>
		
		<p class="p_msj_error"><?php echo $_SESSION['mensaje']; ?></p>

<?php unset($_SESSION['mensaje']); }?>

<div class="conteiner-form " >
<h1 class="h1-form">Editar</h1>

<div class="conteiner-f1">
<form action="validar_modificar_user.php" method="POST">
	<div>
		<label for="nombre"  class="label-f1"> Nombre:</label>
		<input id="nombre" class="input-f1" type="text" name="nombre" value="<?php echo($mostrar['nombre'])?>">
	</div>

	<div>
		<label for="apellido" class="label-f1"> Apellido:</label>
		<input id="apellido" class="input-f1" type="text" name="apellido" value="<?php echo($mostrar['apellido'])?>">
	</div>

	<div>
		<label for="email" class="label-f1"> Email:</label>
		<input id="email" class="input-f1" type="email" name="email" value="<?php echo($mostrar['email'])?>" disabled>
	</div>

	<div>
		<label for="fecha_nac" class="label-f1"> Fecha nacimiento</label>
		<input id="fecha_nac" class="input-f1" type="date" name="fecha_nac" value="<?php echo($mostrar['fecha_nac'])?>">
	</div>

	<div>
	<label for="pass1" class="label-f1"> Contraseña</label>
	<input id="pass1" class="input-f1" type="password" name="pass1" value="<?php echo($mostrar['password'])?>">
	</div>

	<div>
	<label for="pass2" class="label-f1"> Repetir contraseña</label>
	<input  id="pass2" class="input-f1" type="password" name="pass2" value="<?php echo($mostrar['password'])?>">
	</div>
	<button type="submit">Guardar</button>
	<a href="mi_perfil.php">Volver</a>

</form>

</div>
</div>
<?php }else{
	header("Location:index.php");
}
?>