<?php 
include('header.php');

$id= $verificar->id();
include ('funcion_puntuacion.php');
include('img.php');
 ?>
 <a class="btton_volver a-link2  fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>"> Volver </a>
<section>


<div class="container" id="piloto"> 
	 
<?php 
	$consulta="SELECT comentario,puntaje,hora,fecha FROM calificacion  WHERE usuario_id=$_POST[user_id]  AND cumple=1 AND es_sancion=0 AND es_piloto=$_POST[tipo] ORDER BY fecha, hora DESC "; 

$resul2=mysqli_query($link,$consulta);
if (mysqli_num_rows($resul2)<1) { 
	if ($_POST['tipo']==0) {
		$_SESSION['error']="No posee calificaciones como Copiloto";
	}else{
		$_SESSION['error']="No posee calificaciones como Piloto";
	}
	
	header("Location:".$_SERVER["HTTP_REFERER"]);
}


	

	while ($mostrar=mysqli_fetch_array($resul2)) { 
?>
	<article class="mis_vehiculos">
					<div class="container caja_mayor ">
				<p>Puntaje: <?php if ($mostrar['puntaje']==1) {
			echo "Bueno ";
		}elseif ($mostrar['puntaje']==0) {
			echo "Neutro";
		}else echo "Malo"; ?></p>
		<p>Comentario: <?php echo $mostrar['comentario']; ?></p>

		<p style="font-size: 0.9em; color: #777;float: right;"><?php echo "fecha: ".fecha_string($mostrar['fecha'])."-- Hora: ".(substr("$mostrar[hora]", 0, -3)); ?></p>
	</div>
</article>
<?php } ?>
	</div>	

</section>
	<?php
include('footer.php');

//
 ?>
</body>
</html>

