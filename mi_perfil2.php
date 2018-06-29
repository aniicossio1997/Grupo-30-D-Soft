<?php 

include('header.php');

$id= $verificar->id();

include ('mi_puntuacion.php');
include('img.php');

$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$_GET[id_pos] ";
$resul= mysqli_query($link,$sql);
$fila = mysqli_fetch_array($resul);
?>


<section>
	<article class="mi-perfil center f-blanco" >
		<?php
	
			if (isset($_SESSION['mensaje'])) {
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);//mensaje flash
			}
	?>
		<h1 class="margen-abajo h1-perfil"><?php echo $fila['nombre']; ?></h1>
	

	<form id="form_img" action="validar_imagen.php" enctype="multipart/form-data" method="POST">
		<div class="caja_img" style="border-color: #17202A;">

			<img class="img_previo" id="" src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
					echo "fondos/user2.png";
				}
				?>" >
			<div>
		</div>
		</div>
		
	</form>

		<div class="separador">
		
			<div  class="d-perfil">
				<p class="p-perfil">Nombre: <?php echo($fila['nombre']);?></p>
				<p class="p-perfil">Apellido:<?php echo($fila['apellido']);?></p>
				<p class="p-perfil">E-mail:  <?php echo($fila['email']);?></p>
				<p class="p-perfil">Fecha de nacimiento: 
					<?php
				setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
				$fecha = strftime("%d de %B de %Y", strtotime("$fila[fecha_nac]"));
				echo $fecha;
				?></p>
				<p class="p-perfil">Puntuación total como copiloto: 0</p>
				<p class="p-perfil">Puntuacion total como piloto: 0</p>
			</div>
		</div>

	</article>
	<a class="a-link2 fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>">Volver</a>

</section>

<?php
include('footer.php');
mysqli_close($link);
//
 ?>
 <script type="text/javascript" src="js/validar_imagen.js"></script>

</body>

</html>		