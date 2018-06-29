<?php 

  include ('header.php');
  include('funcion_fecha.php');
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

  $precio = floor($mostrar['costo'] / ($fila2['asientos'] + 1))
?>
    <p class="title_fv color-a form_copi " style=" text-align: center;margin-bottom: 2%;">Detalles del viaje</p class="title_fv">
   
    <article class="" ">
     <article class="article_interior" style="margin-top: 0%; border: 1px solid #ccc">
       <b class=" color-a" style="margin-bottom: 1%;"> >Datos del viaje:</b>
      
        <div style="width: 100%; display: inline-block;">
        <div style="width: 60%;">

          <div style="  float: left;">
  		        <p style="color: #000">Origen: <?php echo $mostrar['origen']; ?></p>
              <p style="color: #000">Destino: <?php echo $mostrar['destino']; ?></p>
              <p style="color: #000">Precio: $<?php echo $precio; ?></p>              
              <p style="color: #000">Duración: <?php echo $mostrar['duracion']."Hs-"; echo $mostrar['minutos']."minutos"; ?></p>
              
           </div>

        </div>
        <div style="width: 40%; float: right;margin-left: -12%; ">
  		      <p style="color: #000">Fecha: <?php

          echo fecha_string ($mostrar['fecha']);
              ?></p> 
            <p style="color: #000"> 

              Hora:<?php
      $elimina_segundos=substr("$mostrar[horario]", 0, -3);
      //se elimina los segundos
       echo $elimina_segundos; ?>


             Hs</p>
            <?php if ($mostrar['descripcion'] == "") {?>
  		          <p style="color: #000">Descripcion: Sin descripción.</p>
            <?php }else{ ?>
                         <p style="color: #000">Descripcion: <?php echo $mostrar['descripcion']; ?></p>
            <?php } ?>
            <p style="color: #000"> Cantidad de asientos disponibles: <?php echo ($mostrar['copilotos'] - $fila3 );?></p>  
        </div>

      </div>
      <b class=" color-a" style="margin-bottom: 1%;" > >Datos del vehículo:</b>
      <div>
        <p>Marca: <?php echo $fila2['marca']; ?></p>
        <p>Modelo: <?php echo $fila2['modelo']; ?></p>
        <p>Patente: <?php echo $fila2['patente']; ?></p>
      </div>

      </article>

      </article>
    </article>  

    <form method="POST" action="validar_pregunta.php">
      <label>Realizar una pregunta:</label>
      <textarea style="resize: none; width: 50%;height: 100px;">
        
      </textarea>
      
    </form>
    <p>Preguntas y Respuestas</p>




  <?php if (isset($_GET['detalle'])) {
    header("Location: mostrar_viaje_piloto.php");
  }else{?>
  <div class="div_volver">
      <a class="btton_volver a-link2  fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>"> Volver </a>
      
  </div>

 <?php } 
include('footer.php');
 ?>
  	
  
   