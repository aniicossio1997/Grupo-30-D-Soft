<?php 
include('header.php');

$id= $verificar->id();
$sql="SELECT * FROM vehiculo WHERE usuario_id=$id";

$resul= mysqli_query($link,$sql);

while ($fila = mysqli_fetch_array($resul)) { ?>

	<div  class="">
			<a class=" " onclick="return confirm('¿Esta seguro de eliminar el vehiculo?')"  id ="" href="eliminar_vehiculo.php?vehiculo= <?php echo $fila['id']; ?>">Eliminar</a>
					
			<p class="p-perfil">Marca:  <?php echo($fila['marca']);?></p>
			<p class="p-perfil">Modelo: <?php echo($fila['modelo']);?></p>
			<p class="p-perfil">Patente: <?php echo($fila['patente']);?></p>
			<p class="p-perfil">Asientos:<?php echo($fila['asientos']);?></p>
		</div>

<?php } ?>

