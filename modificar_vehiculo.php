<?php
include('header.php');
$id_vehiculo=$_GET['id_vehiculo'];
$consulta="SELECT id, marca, patente, modelo, asientos FROM vehiculo WHERE id=$id_vehiculo";
$resul=mysqli_query($link,$consulta);
$mostrar=mysqli_fetch_array($resul);

?>



	<div class="conteiner-form">
		<h1 class="h1-form">Modificar vehículo</h1>

	<div class="conteiner-f1">
		<div>
	<?php if (isset($_SESSION['msj'])) { ?>

		<div><?php echo $_SESSION['msj']; ?></div> 
	
	<?php unset($_SESSION['msj']); } ?>

</div>
		<form class="conteiner" action="validar_modificar_vehi.php" method="POST">
			<div>
        		<label class="label-f1"> Marca: </label>
        		<input type="text" name="marca" class="input-f1"  value="<?php  echo $mostrar['marca']; ?>">
        	</div>

        	<div>
        		<label class="label-f1"> Patente:</label>
				<input type="text" name="patente" class="input-f1" value="<?php  echo $mostrar['patente']; ?>">
			</div>

			<div>
        		<label class="label-f1"> Modelo: </label>
				<input type="text" name="modelo" class="input-f1" value="<?php  echo $mostrar['modelo']; ?>">
			</div>

			<div>
        		<label class="label-f1"> Cantidad de asientos: </label>
				<input type="number" name="asientos" class="input-f1" value="<?php echo $mostrar['asientos']; ?>">
				<input type="hidden" name="id_vehiculo" value="<?php  echo $mostrar['id']; ?>">
			</div>

			<div>
				<button  class="input-f1 text-white fondo-blue btn-form" type="submit">Guardar cambios</button>
			</div>
		</form>
</div>
</div>





<?php include('footer.php'); ?>