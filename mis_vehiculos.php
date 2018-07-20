<?php 
include('header.php');
$id= $verificar->id();
$sql="SELECT * FROM vehiculo WHERE usuario_id=$id and activo=1";
$resul= mysqli_query($link,$sql);
$elementos=mysqli_num_rows($resul);
?> 
<?php if (isset($_SESSION['msj']) && $_SESSION['msj']==true) { ?>

		<div><?php echo '<script type="text/javascript">alert("Operacion realizada con éxito!");</script>'; ?></div> 
	
	<?php }else{ if(isset($_SESSION['msj']) && $_SESSION['msj']==false){
		echo '<script type="text/javascript">alert("No puede modificar un vehiculo que se encuentra a una publicación");</script>'; }
		 } unset($_SESSION['msj']); ?>

<div>
	<?php if (isset($_SESSION['msj_baja_v'])) { ?>

		<div><?php echo $_SESSION['msj_baja_v']; ?></div> 
	
	<?php unset($_SESSION['msj_baja_v']); } ?>
</div>
<section>

	<div class=" caja_mis_v fondo_gris">
<p class="title_fv color-a txt_mis_v">Mis vehiculos</p></div>
<?php if ($elementos==0) { ?>

	<article class="mis_vehiculos"><p class="text_center">Usted no posee vehiculos...<a class="color-a" href="agregar_vehiculo.php"> Agregar vehículo</a>
	</p></article>
<?php } ?>	



<?php
	while ($fila = mysqli_fetch_array($resul)) { ?>
	<article class="mis_vehiculos">	
		<table class="tabla" >
		  <tr style="height: 50px">
		    <td  class="td-p">
		    	<p class="p-perfil p-left ">Marca: <?php echo($fila['marca']);?>
		    	</p>
		    </td>
		    <td class="td-p"> 
		    	<p class="p-perfil p-left ">Modelo: <?php echo($fila['modelo']);?>
		    	</p>
		    </td> 
		    <td class="td-a"> 
		    	<a class="a-link2 a-rig fondo-blue" href="modificar_vehiculo.php?id_vehiculo=<?php echo $fila['id']; ?>">Modificar<span class="icon-pencil2"></span>

		    	</a>
		    </td>

		  </tr>

		  <tr>
		    <td class="td-p">
		    	<p class="p-perfil p-left ">Patente: <?php echo($fila['patente']);?>
		    	</p>
		    </td>
		    <td class="td-p">
		    	<p class="p-perfil p-left ">Asientos: <?php echo($fila['asientos']);?>
		    	</p>
		    </td>
		    <td class="td-a">
		    	<a class="a-link2 a-rig fondo-blue " onclick="return confirm('¿Usted esta seguro de proceder con la eliminación?')"  id ="" href="eliminar_vehiculo.php?vehiculo= <?php echo $fila['id']; ?>">Eliminar<span class="icon-bin"></span>
		    	</a>
		    </td>
		  </tr>
		</table>
		

	</article>
	
	<?php } ?></section>

	<?php include('footer.php');
	mysqli_close($link);
	 ?>

</body>
</html>


