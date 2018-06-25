<?php 

  include ('header.php');
  $id = $verificar->id();
  
  $consulta3 = "SELECT * FROM postulantes where (viaje_id = $_GET[id_viaje]) AND (rechazado = 2)";
  $resultado3 = mysqli_query($link,$consulta3);
  $fila3 = mysqli_num_rows($resultado3);

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
    <h1 class="h1-form"> Detalles del viaje </h1> 
    <b style= "style: italic; color:black"> Detalle del viaje:</b>
  	<article class="article_exterior">
      <b class="parrafo" > Datos del viaje:</b>
      <article class="article_interior" style="margin-top: 0%;">
        <div style="width: 100%; display: inline-block;">
        <div style="width: 50%;">

          <div style="width: 30%;  float: left;">
  		        <p style="color: #000">Origen: <?php echo $mostrar['origen']; ?></p>
              <p style="color: #000">Destino: <?php echo $mostrar['destino']; ?></p>
              <p style="color: #000">Precio: $<?php echo $precio; ?></p>              
              <p style="color: #000">Duración: <?php echo $mostrar['duracion']; ?></p>
           </div>

        </div>
        <div style="width: 30%; margin-left:  30%">
  		      <p style="color: #000">Fecha: <?php
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
      $fecha = strftime("%d de %B de %Y", strtotime("$mostrar[fecha]"));
      echo $fecha;
              ?></p> 
            <p style="color: #000"> Hora: <?php echo $mostrar['horario'];?>Hs</p>
            <?php if ($mostrar['descripcion'] == "") {?>
  		          <p style="color: #000">Descripcion: Sin descripción.</p>
            <?php }else{ ?>
                         <p style="color: #000">Descripcion: <?php echo $mostrar['descripcion']; ?></p>
            <?php } ?>
            <p style="color: #000"> Cantidad de asientos disponibles: <?php echo ($mostrar['copilotos'] - $fila3 );?></p>  
        </div>
      </div>
      </article>
      <b class="parrafo" > Datos del vehículo:</b>
      <article class="article_interior" style="margin-top: 0%;">
        <p>Marca: <?php echo $fila2['marca']; ?></p>
        <p>Modelo: <?php echo $fila2['modelo']; ?></p>
        <p>Patente: <?php echo $fila2['patente']; ?></p>
        
      </article>
      <b class="parrafo" > Comentarios:</b>
      <div style="margin-top: 0%">
          <article class="article_interior" style="width: 50%; margin-left:  1%;background-color: #FADBD8; margin-top: 0% ">
            <b >Claudio comento: </b>
            <p style="margin-left: 10%"> ¿Permite llevar mascotas? </p>
         </article>
         <article class="article_interior" style="width: 50%; margin-left:    10%;">
            <b > tú comentaste: </b>
            <p style="margin-left: 10%"> claro!! </p>
      </div>
      </article>
    </article>  
  <div class="div_volver">
      <a class="btton_volver a-link2  fondo-blue" href="inicio.php"> Volver </a>
      
  </div>
 <?php 
include('footer.php');
 ?>
  	
  
   