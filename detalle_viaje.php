<?php 

  include ('header.php');
  $id = $verificar->id();
  

  $consulta1 = "SELECT * FROM viajes where id = $_GET[id_viaje]";
  $resul=mysqli_query($link,$consulta1);
  $mostrar=mysqli_fetch_array($resul);

  //la siguiente consulta se usa para recuperar los atos del vehiculo
  $vehiculo_id = $mostrar['vehiculo_id'];
  $consulta2 = "SELECT * FROM vehiculo WHERE id = $vehiculo_id";
  $resultado2 = mysqli_query($link,$consulta2);
  $fila2 = mysqli_fetch_array($resultado2); 

  $precio = round($mostrar['costo'] / ($fila2['asientos'] + 1))
?>

    <b style= "style: italic; color:black"> Detalle del viaje:</b>
  	<article class="article_exterior">
      <article class="article_interior">
        <div>
        <div style="width: 50%;">

          <div style="width: 30%; margin: 10%;">
  		        <p class="lado">Origen: <?php echo $mostrar['origen']; ?></p>
              <p class="lado">Destino: <?php echo $mostrar['destino']; ?></p>
              <p class="lado">Precio: $<?php echo $precio; ?></p>
           </div>

        </div>
        <div style="width: 50%;">
  		      <p class="lado">Duración: <?php echo $mostrar['duracion']; ?></p>
  		      <p>Fecha: <?php echo $mostrar['fecha']; ?></p> 
            <p> Hora: <?php echo$mostrar['horario'];?></p>
  		      <p>Descripcion: <?php echo $mostrar['descripcion']; ?></p>
        </div>
      </div>
      </article>
      <b  style= "style: italic; color:black;">Vehículo:</b>
      <article class="article_interior">
        <p>Marca: <?php echo $fila2['marca']; ?></p>
        <p>Modelo: <?php echo $fila2['modelo']; ?></p>
        <p>Patente: <?php echo $fila2['patente']; ?></p>
      </article>
    </article>

  	<article>
  		<h4 style="background-color:#ff4d4d"> Comentarios:</h4>
  		<p></p>
  	</article> 
	  
 <?php 
include('footer.php');
 ?>
  	
  
   