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
		<form class="conteiner" id="form1"  method="POST" action="validar_modificar_vehi.php"
>
			<div>
        		<label> Marca: </label><span class="error_vehiculo" id="error_marca"></span>
        		<input type="text" name="marca" id="marca" class="input-f1" value="<?php  echo $mostrar['marca']; ?>">
        	</div>

        	<div>
        		<br>
        		<label> Patente:</label><span class="error_vehiculo" id="error_patente"></span>
				<input type="text" name="patente" id="patente" class="input-f1" value="<?php  echo $mostrar['patente']; ?>">
			</div>

			<div>
				<br>
        		<label> Modelo: </label><span class="error_vehiculo" id="error_modelo"></span>
				<input type="text" name="modelo" id="modelo" class="input-f1" value="<?php  echo $mostrar['modelo']; ?>">
			</div>

			<div>
				<br>
        		<label> Cantidad de asientos: </label><span class="error_vehiculo" id="error_asientos"></span>
				<input type="number" id="asientos" name="asientos" class="input-f1" value="<?php echo $mostrar['asientos']; ?>">
				<input type="hidden" name="id_vehiculo" value="<?php  echo $mostrar['id']; ?>">
			</div>

			<div>
				<button  class="btn-img fondo-blue btn-a btn-form" type="submit" >Guardar cambios</button>
			</div>
		</form>
</div>
</div>

<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_modificacion_vehiculo.js"></script>
</body>
</html>