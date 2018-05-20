<?php 

include('header.php');

$id= $verificar->id();

include ('mi_puntuacion.php');

$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$id ";
$resul= mysqli_query($link,$sql);


//echo $id;

?>

<section>
	<article class="mi-perfil center f-blanco">
		<span><a class="edit" href="modificar_usuario.php">Editar</a></span>
		<h1 class="margen-abajo h1-perfil">Mi perfil</h1>
		<?php $fila = mysqli_fetch_array($resul); ?>

		<div  class="d-perfil">
			<p class="p-perfil">Nombre:      <?php echo($fila['nombre']);?></p>
			<p class="p-perfil">Apellido: 	<?php echo($fila['apellido']);?></p>
			<p class="p-perfil">E-mail:      <?php echo($fila['email']);?></p>
			<p class="p-perfil">Fecha de nacimiento: <?php echo($fila['fecha_nac']);?></p>
			<p class="p-perfil">Puntuación total: <?php echo(ver_puntuacion($fila['id'],$link))?></p>
		</div>
		
			<a href="">ver mis viajes</a>
			<a href="">ver mis calificaciones</a>
			<a href="mis_vehiculos.php">Ver mis vehiculos</a>
		

		



	</article>
</section>

<?php include('footer.php'); ?>