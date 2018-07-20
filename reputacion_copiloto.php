<?php 
	include('header.php');
    //include('funcion_fecha.php');
	$id= $verificar->id();
  
	$consulta= "SELECT * FROM  calificacion WHERE usuario_id = $id  AND puntaje = 1 ";// positivos
    //echo($consulta);
	$resultado= mysqli_query($link,$consulta);
	$mostrar= mysqli_num_rows($resultado);

	$consulta2 = "SELECT * FROM  calificacion WHERE usuario_id = $id  AND puntaje = -1 ";// negativos
    //echo($consulta);
	$resultado2= mysqli_query($link,$consulta2);
	$mostrar2= mysqli_num_rows($resultado2);
?>
<h1 class ="h1_form color-a"> Reputacion Como Copiloto</h1>
<form  style="margin: 0% auto;width:80%">
	<b class="p-perfil p-left" style="font-style: italic; margin-left: 4%">Puntaje total como copiloto: <?php echo ($mostrar - $mostrar2); ?></b>
	<article class="article_interior">
		<b>Lista de calificaciones:</b>
	<?php $consulta3 = "SELECT * FROM calificacion WHERE usuario_id = $id AND modo_calificacion= 0";
		  $resultado3 = mysqli_query($link,$consulta3);
		  $cantidad = mysqli_num_rows($resultado3);
		  if ($cantidad > 0) {
			  while ( $fila3 = mysqli_fetch_array($resultado3)) { 
					if( $fila3['puntaje'] == 0) //neutro
					  $puntaje= "Neutro";
					if( $fila3['puntaje'] == -1) //malo
					  $puntaje= "Malo";
					if( $fila3['puntaje'] == 1) //bueno
					  $puntaje= "Bueno"; 
					$consulta4 = "SELECT nombre FROM usuarios WHERE id = $fila3[usuario_id]";
					$resultado4 = mysqli_query($link,$consulta4);
					$fila4 = mysqli_fetch_array($resultado4);
			  ?>
					<article class="article_interior">
						<div style="width: 25%; ">
							<label>Fecha: <?php echo($fila3['fecha']) ?></label>
							<br>
							<label>Puntaje: <?php echo($puntaje) ?></label>
						</div>
						  <div style="margin-left: 35%; margin-top: -6%">
							<label >Comentario: <?php echo($fila3['comentario']) ?></label>
							<br>
							<label>Calificador: <?php echo($fila4['nombre']) ?></label>
						  </div>
				    </article>	  	
	         <?php }?>
	    <?php }else{ ?>
	    			<article class="article_interior">
	    				<b> Sin calificaciones por el momento </b>
	    			</article>
	    	  <?php } ?>
	</article>
</form >
