<?php 

  include ('header.php');
include ('funcion_puntuacion.php');
  $id = $verificar->id();
  if (!empty($_SESSION['id_viaje'])) {
    $id_viaje = $_SESSION['id_viaje'];
    unset($_SESSION['id_viaje']);
  }elseif (!empty($_GET['id_viaje'])) {
    $id_viaje = $_GET['id_viaje'];
    unset($_GET['id_viaje']);
  }

  $consulta3 = "SELECT * FROM postulantes where (viaje_id = $id_viaje) AND (rechazado = 2)";
  $resultado3 = mysqli_query($link,$consulta3);
  $fila3 = mysqli_num_rows($resultado3);

  $consulta1 = "SELECT * FROM viajes where id = $id_viaje";
  $resul=mysqli_query($link,$consulta1);
  $mostrar=mysqli_fetch_array($resul);

  //la siguiente consulta se usa para recuperar los datos del vehiculo
  $vehiculo_id = $mostrar['vehiculo_id'];
  $consulta2 = "SELECT v.patente,v.marca,v.modelo, u.nombre, u.apellido,v.usuario_id   FROM vehiculo v INNER JOIN usuarios u on (v.usuario_id=u.id)WHERE v.id = $vehiculo_id";
  #echo $consulta2;
  $resultado2 = mysqli_query($link,$consulta2);
  $fila2 = mysqli_fetch_array($resultado2); 

  $precio = floor($mostrar['costo'] / ($mostrar['copilotos'] + 1));

  if ((isset($_GET['responder']) && isset($_GET['id_pregunta']))) { ?>
    <form id="form1" method="POST" action="validar_pregunta.php?id_pregunta=<?php echo($_GET['id_pregunta'])?>&id_viaje=<?php echo($id_viaje) ?>">
      <script>
        function ocultar_cartel()
        {
          var cartel=document.getElementById('cartel');
          cartel.classList.add('ocultar');
        }     
      </script>
      <div class="cartel div-externo " style="margin-left: 20%; margin-top: 10%;" id="cartel">
        <div>
          <b><?php echo $_GET['nombre_preg']; ?> pregunto:</b>
        </div>
        <div style="margin-left: 8%; margin-top: 3%">
          <p><?php echo $_GET['pregunta']; ?></p>
        </div>
         <div style="margin-top: 5%">
            <textarea  placeholder="Responder.." name="resp" id="resp" style="resize: none; width: 85%; height: 300px; margin-left: 8%; margin-top: 1%; height: 5%;"  ></textarea>
          </div> 
          <div style="margin-top: 6%; margin-left: 50%; padding: 1%; box-sizing: border-box;">
            <div style="margin-left: 0%; margin-top: 0%; display: inline-block;">
              <button id="btn" class="btn btn-primary" style=" font-size: 1.2em; margin-top: 2%;"> Enviar</button>
            </div>
            <div style=" display: inline-block; margin-left:7%; ">
              <a  class="btn btn-danger " onclick="return ocultar_cartel()" style=" font-size: 1.2em;" >Cancelar</a>
            </div>
          </div>
    </div>
    </form>
    <?php unset($_GET['responder']); unset($_GET['id_pregunta']); unset($_GET['nombre_preg']);} ?>


<!--  - - - - - - - - - -VIAJE - - - - - - - - - - -  -->
    <p class="title_fv color-a form_copi " style=" text-align: center;margin-bottom: 2%;">Detalles del viaje</p class="title_fv">
   
    <article class="mis_vehiculos" style="width: 90%">
<table class="table" style="margin-bottom: -0.9%;">
 
  <thead class="color-a">
    <th >Datos del Publicador</th>
    <th></th>
    <th></th>
  </thead>
  <tbody style="color: #000"><tr>
    <td>
    <?php echo $fila2['nombre'].",".$fila2['apellido']; ?>
    </td>
    <td>
      <?php echo puntuacion_piloto($link,$fila2['usuario_id']); ?></td>
  </tr>
</tbody>
  
</table>
      
      <table class="table" style="margin-bottom: -1%">
<thead class="color-a">
    <th>Informacíón del viaje:</th>
    <th></th>
    <th></th>
  </thead>

        <tbody style="color: #000">
          <tr>
            <td>
              Origen: <?php echo $mostrar['origen']; ?>
            </td>
            <td>Destino: <?php echo $mostrar['destino']; ?></td>
            <td>Fecha: <?php echo fecha_string ($mostrar['fecha']);
              ?>
            </td>
          </tr>
          <tr>
          <td> Hora:<?php echo substr("$mostrar[horario]", 0, -3)."hs"; //se elimina los segundos  ?>
          </td>
            
            <td>Duración: <?php echo $mostrar['duracion']."hs - "; echo $mostrar['minutos']." minutos"; ?></td>
         <td>Precio: $<?php echo $precio; ?></td>
          </tr>
          <tr>
             <td>
            <?php if ($mostrar['descripcion'] == "") {?>
                <p>Descripcion: Sin descripción.</p>
            <?php }else{ ?>
                         <p style="color: #000">Descripcion: <?php echo $mostrar['descripcion']; ?></p>
            <?php } ?>
          </td>
          </tr>
        </tbody>
      </table>
      <table class="table" style="margin-bottom: -2%">
<thead class="color-a">
    <th>Información del vehículo:</th>
    <th></th>
    <th></th>
  </thead>
        <tbody>
          <tr>
            <td>Marca: <?php echo $fila2['marca']; ?></td>
            <td>Cantidad de asientos: <?php echo ($mostrar['copilotos']);?></td> 
           
          </tr>
          <tr>
             <td>Modelo: <?php echo $fila2['modelo']; ?></td>
             <td>Patente: <?php echo $fila2['patente']; ?></p></td>
          </tr>
        </tbody>
      </table>

      </article>

   <!-- - - - - - - - - - - - - - - -->
    <?php if (isset($_GET['detalle'])) {
    header("Location: mostrar_viaje_piloto.php");
  }else{?>
  <div class="div_volver">
      <a class=" a-link2  fondo-blue" style="float: right; margin-right: 5%" href="<?=$_SERVER["HTTP_REFERER"]?>"> Volver </a>

  </div>
 <?php } ?>
 <br>
 <br>



    <!-- - - - -- -  PREGUNTAS Y RESPUESTAS - - - - -- - - - - -->

      <article class="article_interior" style="margin-top: 1%;">

        <?php
        $fecha_act=date('Y-m-d');


         if ($mostrar['fecha']> $fecha_act) { ?>
        
        
        <?php if ($fila2['usuario_id'] != $id) { ?>
          <b class=" color-a" style="margin-left: 0%;"> >Realizar una pregunta: </b>
          <form method="POST" action="validar_pregunta.php?id_viaje=<?php echo $id_viaje ?>&id_usuario=<?php echo $id ?>">
          <div style="margin-left: 4%; margin-top: -1.5%;">
          <br>
          <textarea class="focus_azul" name="preg" id="preg" style="resize: none; width: 70%; height: 100px; margin-left: -0%; margin-top: 0%"> </textarea>
          <div style="margin-left: 0.2%;  margin-top: -0.1%;">
                <button  class="btn btn-primary" type="submit">Preguntar</button>
          </div> 
        </div>
        <br>
        <br>
      <?php } } ?>


    <div style="margin-top: -1%;">
    <b class=" color-a" style="margin-left: 4%; margin-left: 0%;">Preguntas y Respuestas</b>
    </div>
  </form>
    <?php 
      $consulta4 = "SELECT * FROM preguntas WHERE viaje_id = $id_viaje ORDER BY fecha_pregunta, hora_pregunta DESC ";
      $resultado4 = mysqli_query($link,$consulta4);
      $cantidad = mysqli_num_rows($resultado4);
      if ($cantidad > 0) {
      while ($fila4 = mysqli_fetch_array($resultado4)) {
            //la siguiente consulta es para obtener las repuestas que tiene la pregunta
            $consulta5 = "SELECT * FROM preguntas where id = $fila4[id]  ORDER BY fecha_pregunta, hora_pregunta DESC";
            $resultado5 = mysqli_query($link,$consulta5);
            $fila5 = mysqli_fetch_array($resultado5);
            $consulta7 = "SELECT nombre FROM usuarios where id = $fila5[preguntador_id]";
            $resultado7 = mysqli_query($link,$consulta7);
            $fila7 = mysqli_fetch_array($resultado7);
        ?>
       <article class="article_interior" style="width: 50%; margin-left: 4%;">
        <?php 
        $pertenece = false;//variable que se usa para saber si una pregunta pertenece al usuario en sesion y en caso afirmativo mostrar la opcion de eliminar pregunta
        if ($fila5['preguntador_id'] == $id) { $pertenece = true; ?>
                  <div>
                    <b> tú preguntaste: </b>
                  </div>
                  <p><?php echo($fila4['pregunta']) ?></p>
        <?php }else{ ?>
                    <div>
                      <b><?php echo $fila7['nombre']; ?> pregunto: </b>
                    </div>
                    <p><?php echo($fila4['pregunta']) ?></p>
            <?php } ?>
            <hr size="3"  style="margin-top: 1%;">
            <div style="margin-top: 1%; margin-left: 50%">
              <b style="font-size: 80%">fecha: <?php echo $fila5['fecha_pregunta']; ?></b>
            </div>
            <div style="float: right; margin-top: -4.2%">
              <b style="font-size: 80%">Hora: <?php echo $fila5['hora_pregunta']; ?></b>
            </div>
       </article> 
       <?php if ($pertenece == true) { ?>
                <div style="margin-top: 1%; margin-left: -2%">
                  <a class="btton_volver a-link2  fondo-blue" href="validar_pregunta.php?id_pregunta=<?php echo $fila4['id'] ?>&eliminar_pregunta=<?php echo '1' ?>&id_viaje=<?php echo($id_viaje) ?> "> Eliminar pregunta</a> 
                </div>
       <?php }  ?>
          <?php
            if ($fila5['respuesta'] != null) {
              //la siguiente consulta es para obtener el nombre del usuario que respone la pregunta
              $consulta6 = "SELECT nombre, id FROM usuarios WHERE id = $fila5[usuario_id]";
              $resultado6 = mysqli_query($link,$consulta6);
              $fila6 = mysqli_fetch_array($resultado6); ?>
              <article class="article_interior" style="width: 50%; margin-left: 8%;">
        <?php if ($fila5['usuario_id'] == $id) { ?>
               <b> tú respondiste: </b>
               <div style="margin-left: 3%;">
                 <p>- <?php echo($fila5['respuesta']) ?></p>
               </div>
            <?php }else{ ?>

                          <b> <?php echo ($fila6['nombre']); ?> respondio: </b>
                          <div style="margin-left: 3%;">
                            <p>- <?php echo($fila5['respuesta']) ?></p>
                          </div>
             <?php } ?>
                <hr size="3"  style="margin-top: 1%;">
                <div style="margin-top: 1%; margin-left: 50%">
                  <b style="font-size: 80%">fecha: <?php echo $fila5['fecha_respuesta']; ?></b>
                </div>
                <div style="float: right; margin-top: -4.2%">
                  <b style="font-size: 80%">Hora: <?php echo $fila5['hora_respuesta']; ?></b>
                </div>
             </article>
             <?php
             if ($fila5['usuario_id'] == $id) { ?>
                        <div style="margin-top: 1%; margin-left: 2%">
                          <a class="btton_volver a-link2  fondo-blue" href="validar_pregunta.php?id_viaje=<?php echo($id_viaje) ?>&id_pregunta=<?php echo($fila4['id']) ?>">Eliminar comentario</a>
                        </div>
                    <?php } ?>
            <?php }elseif ($fila5['usuario_id'] == $id) { ?>
                        <div style="margin-top: 1%; margin-left: 5.5%;">
                           <a class="btton_volver a-link2  fondo-blue" href="detalle_viaje.php?id_viaje=<?php echo($id_viaje) ?>&responder=<?php echo("1") ?>&id_pregunta=<?php echo($fila4['id'])?>&nombre_preg=<?php echo ($fila7['nombre']) ?>&pregunta=<?php echo $fila4['pregunta']?>">Responder</a>
                        </div>
            <?php } ?>
       <?php } }elseif ($fila2['usuario_id'] == $id) {?>
                    <div style="margin-left: 38%;">
                      <b>Sin preguntas por el momento...</b>
                    </div>
      <?php   } if (mysqli_num_rows($resultado4)==0) { ?>
       <div style="margin-left: 38%;">
                      <b>No posee preguntas...</b>
                    </div>
      <?php } ?>
  </article> 

 
 <?php 
include('footer.php');
 ?>
 <script type="text/javascript" src="js/validar_pregunta.js"></script>
</body>
</html>
    
  
   