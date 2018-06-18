<?php 

include('header.php');

$id= $verificar->id();

include ('mi_puntuacion.php');
include('img.php');

$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$id ";
$resul= mysqli_query($link,$sql);
$fila = mysqli_fetch_array($resul);

//echo $id;


?>


<div class="">	
<div class="center menu">
	<a class="btn-link color-a fondo-blue" href="mis_vehiculos.php">Ver mis vehiculos</a>	
	<a class="btn-link  fondo-blue" href="mis_viajes.php">ver mis viajes de copiloto</a>
	<a class="btn-link fondo-blue" href="agregar_vehiculo.php"> Agregar vehículo</a>
	<a class="btn-link fondo-blue" href="mostrar_viaje_piloto.php"> Mis como viajes Piloto</a>
	
	</div>
</div>

<section>
	<article class="mi-perfil center f-blanco">
		<?php
	
			if (isset($_SESSION['mensaje'])) {
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);//mensaje flash
			}
	?>
		<h1 class="margen-abajo h1-perfil">Mi perfil</h1>
	

	<form id="form_img" action="validar_imagen.php" enctype="multipart/form-data" method="POST">
		<div class="caja_img">
		
			<label id="img" for="imagen">
				

			<img class="img_previo" id="img_previa" src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
					echo "fondos/user2.png";
				}
				?>" >

			<!--<div  id="aux_file" class="caja_file">
				<p  class="p_img"><span class="icon-images"></span>Subir</p>
				<span id="text_auxiliar">Ninguna imagen seleccionada</span>accept="image/*"
				accept="image/*"
			</div>-->

			<input class="ocultar" type="file" accept="image/*" name="foto" id="imagen"  >
			<div class="falso_input fondo-blue">Elegir una imagen</div>
			</label>
			<div>
			<button class="btn-img fondo-blue btn-a " type="submit">Guardar cambios</button>
		</div>
		</div>
		
	</form>

		<div class="separador">
			<span><a class="edit fondo-blue btn-a " href="modificar_usuario.php">Editar <span class="icon-pencil2"></span></a></span>
		
			<div  class="d-perfil">
				<p class="p-perfil">Nombre: <?php echo($fila['nombre']);?></p>
				<p class="p-perfil">Apellido:<?php echo($fila['apellido']);?></p>
				<p class="p-perfil">E-mail:  <?php echo($fila['email']);?></p>
				<p class="p-perfil">Fecha de nacimiento: <?php echo($fila['fecha_nac']);?></p>
				<p class="p-perfil">Puntuación total como copiloto: Sin desarrollo</p>
				<p class="p-perfil">Puntuacion total como piloto: Sin desarrollo</p>
			</div>
		</div>

	</article>
</section>

<?php
include('footer.php');
mysqli_close($link);
//
 ?>
 <script type="text/javascript" src="js/validar_imagen.js"></script>

</body>

</html>