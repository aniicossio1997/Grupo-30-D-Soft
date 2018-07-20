<?php 

include('header.php');

$id= $verificar->id();

include ('funcion_puntuacion.php');
include('img.php');

$sql="SELECT id, tipoimagen, contenidoimagen, email, password, nombre, apellido, fecha_nac FROM usuarios where id =$id ";
$resul= mysqli_query($link,$sql);
$fila = mysqli_fetch_array($resul);

//echo $id;


?>
<section id="section" style="width: 100%;"></section>

<?php
//cartel-----------------------------------------------------------------
//se utiliza ara confirmar la eliminacion del usuario.
if (isset($_SESSION['confirmacion'])) {$a = 1?>
	<div class="cartel div-externo" style="margin-left: 27%;" id="cartel">
		<div class="div-interno " style="margin-top: 10%;">
	  		<p style="text-align: center; color: white; font-style: italic;"> <?php echo $_SESSION['confirmacion']; unset($_SESSION['confirmacion']); ?></p>
	    </div>
	    <div class="div-bttn-ok" style=" margin-top: 10%;">
	    	<a class=" a-link2  fondo-blue" style="margin-top: 100%;" href="baja_usuario.php?id_usuario=<?php echo $id ?>&respuesta=<?php echo $a ?>"> Ok</a>
	    	<a class=" a-link2  fondo-blue" onclick="return ocultar_cartel();" href="">Cancelar</a>
	    </div>
	</div>

<?php } 
//--fin cartel------------------------------------------------------------
?>
	<?php	

		//--------------------------------------
	
			if (isset($_SESSION['mensaje'])) {
				echo $_SESSION['mensaje'];
				unset($_SESSION['mensaje']);//mensaje flash
			}
	?>
<br>

<div style="width: 84%;margin: 0 auto;">
	<a class="btn btn-danger " href="baja_usuario.php"> Eliminar mi cuenta</a>
</div>
<section>

	<article class=" mis_vehiculos f-blanco">

<!-- BOTON ELIMINAR -->

	
	
</div>

<div class="caja_perfil">
	
	<form id="form_img" action="validar_imagen.php" enctype="multipart/form-data" method="POST">

		<div class="caja_img">
		
			<label class="curso_poi"  id="img" for="imagen">
				

			<img class=" img-circle" id="img_previa" style="cursor: pointer; width: 200px;height: 200px; float: left;"  src="<?php if (hay_imagen($fila['id'],$link)){?>mostrar_imagen.php?id=<?php echo $fila['id'];?><?php }else{
					echo "fondos/user2.png";
				}
				?>" >

			<input style="visibility: hidden;" type="file" accept="image/*" name="foto" id="imagen"  >
			<div class="btn btn-link">Elegir una imagen</div>
			</label>
			<div>
			<button class="btn btn-primary " type="submit">Guardar cambios</button>
		</div>
		</div>

		
	</form>
</div>

		<div  class="caja_datos" style="float: right;">
			
			<div class="caja_perfil_II">
				<span><a class="edit fondo-blue btn-a " href="modificar_usuario.php">Editar <span class="icon-pencil2"></span></a></span>
				<p class="pf_txt">Información personal:</p>
				
				<p class="pf_txt">Nombre: <?php echo($fila['nombre']);?></p>
				<p class="pf_txt">Apellido:<?php echo($fila['apellido']);?></p>
				<p class="pf_txt">E-mail:  <?php echo($fila['email']);?></p>
				<p class="pf_txt">Fecha de nacimiento: 
					<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
				$fecha = strftime("%d de %B de %Y", strtotime("$fila[fecha_nac]"));
				echo $fecha;
				?></p>
				<p class="pf_txt">Edad: <?php echo edad($fila['fecha_nac']);?> años</p>

				<p><?php 
				echo puntuacion_piloto($link,$id);
				 ?>
				 <form action="calificaciones.php" method="POST" style="margin-top: -2%">
				 	<input type="hidden" name="tipo" value="1">
				 	<input type="hidden" name="user_id" value="<?php echo $id; ?>">
				 	<button type="submit" class="btn btn-link" name="mostrar_cal">Más detalles..</button>
				 </form>
				 	</p>
				 <?php /* 	<a style="display: block;" href="mis_calificaciones_como_piloto.php">
				 Ver más detalles..</a>*/ ?>
				 


				<p><?php 
				echo puntuacion_copiloto($link,$id);
				 ?>
				 	<form action="calificaciones.php" method="POST" style="margin-top: -2%;">
				 		<input type="hidden" name="user_id" value="<?php echo $id ?>">
				 	<input type="hidden" name="tipo" value="0">
				 	<button type="submit" class="btn btn-link" name="mostrar_cal">Más detalles..</button>
				 </form>
				<?php /* <a style="display: block;" href="mis_calificaciones_como_copiloto.php">
				 Ver más detalles..</a>  */ ?> 	  
				 </p>
			</div>
		</div>

			
		

	</article>
</section>


<br>
<?php
include('footer.php');

//
 ?>

 <script type="text/javascript" src="js/validar_imagen.js"></script>
<script>	
	function ocultar_cartel()
	{
		var cartel=document.getElementById('cartel');
		cartel.classList.add('ocultar');
    }
</script>
<?php  mysqli_close($link); ?>
</body>

</html>