<?php 


  include ('header.php');
  $id = $verificar->id(); 


  $viajes = "SELECT vj.id,vi.usuario_id,vj.horario,vj.tipo,vj.activo,vj.copilotos,vj.costo,vj.duracion,vj.descripcion,vj.destino,vj.fecha, vj.minutos,vj.tipo,vj.origen, vj.vehiculo_id FROM vehiculo vi  INNER JOIN usuarios u ON (vi.usuario_id=u.id)  INNER JOIN viajes vj ON (vj.vehiculo_id=vi.id) WHERE vi.usuario_id=$id order by vj.id desc " ;
  $datos=mysqli_query($link,$viajes);


?>

  <h1 class="h1-form">Mis viajes como Piloto </h1>
<div class=" div_incio" style="margin-top: 4%; width: 80%">
 <?php while ($vector =mysqli_fetch_array($datos) ) { 
   if ($vector['activo'] != 2) {
   
 	?> 
       <?php

if (isset($_SESSION['mensaje'])) { ?>
  <div class="cartel div-externo"  id="cartel">
    <div class="div-interno " style="margin-top: 10%;">
        <p style="text-align: center; color: white; font-style: italic;"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
      </div>
      <div class="div-bttn-ok"">
        <a class="a-link2  fondo-blue " style="margin-left: 1%; margin-top: 0%;" id="cerrar" href=""> Ok</a>
      </div>
  </div>
<?php } ?>
      

	<article class="article_exterior">
      <article class="article_interior" style="margin-top: 0%">
        <div style="width: 100%; display: inline-block; ">
        <div style="width: 50%;">

          <div style="width: 70%;  float: left;">
		        <p  class="p-perfil p-left" style="font-style: italic;">Fecha:
              <?php
                 setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                 $fecha = strftime("%d de %B de %Y", strtotime("$vector[fecha]"));
                 echo $fecha;
              ?>
            </p>
			    <p class="p-perfil p-left" style="font-style: italic;">Origen: <?php echo ($vector['origen']); ?>
				</p>
		        <p  class="p-perfil p-left"  style="font-style: italic;">Destino: <?php echo ($vector['destino']); ?> 
            </p>	
		        <p  class="p-perfil p-left" style="border:5 solid pink;" style="font-style: italic;">     Hora: 
              <?php 
                 $elimina_segundos=substr("$vector[horario]", 0, -3);
                 echo $elimina_segundos;?> Hs
		    	  </p>		        					        
           </div>
          </div>
        <div style="width: 30%; margin-left:  30%">
                  <p  class="p-perfil p-left" style="font-style: italic;">Duración:<?php echo $vector['duracion']."hs - ".$vector['minutos']." minutos"; ?>
		    	 </p>
		    	<p class="p-perfil p-left" style="font-style: italic;">Precio: $<?php echo (round($vector['costo'] / ($vector['copilotos'] + 1))); ?>		
		    		</p>
		    		<p class="p-perfil p-left" style="font-style: italic;">Tipo de viaje: <?php echo ($vector['tipo']); ?>		
		    		</p>

        </div>
      </div>
      </article>
      <div style="margin-top: 1%">
      	<a style="margin-left: 0.5%" class="a-link2 fondo-blue" href="detalle_viaje.php?id_viaje=<?php echo $vector['id'] ?>&detalle<?php echo "1" ?>">Detalle</a>
      </div>
      <div style="margin-top: -2.4%">
      <?php 
            //la siguiente consulta es unsada para saber si la publicacion tiene postulantes.
           $consulta1 = "SELECT * FROM postulantes WHERE (viaje_id = $vector[id]) AND (estado = 1) AND    (rechazado = 0 OR rechazado = 2)";
           $resultado1 = mysqli_query($link,$consulta1);
           $fila = mysqli_num_rows($resultado1);
           if ($fila == 0) { ?>
               <a style="margin-left:  7.5%; margin-top: -5%;" class="a-link2 fondo-blue"  href="      modificar_viaje.php?id_vehiculo=<?php  echo $vector['vehiculo_id'];?>&id_viaje=<?php   echo $vector['id']; ?>&id_pag=<?php echo "mis_viajes" ?>&cantidad=<?php echo $fila ?>&modificar=<?php echo "1" ?> ">Modificar</a>
      <?php }else{ ?>
                   <a style="margin-left:  7.5%; margin-top: -5%;" class="a-link2  fondo-blue " href="modificar_viaje.php?id_vehiculo=<?php  echo $fila['vehiculo_id'];?>&id_viaje=<?php echo $fila['id']; ?>&cantidad=<?php echo $fila ?>&modificar =<?php echo "1" ?> ">Modificar
                   </a>

       <?php }?>
      </div>
      </article>
 <?php } }

 ?>
 </div>

 <div style=" margin-top: 0.9%;width: 100%; box-sizing: border-box;" >
    <a style="margin-left:  45%;" class="a-link2 fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>">Volver</a>
 </div>

 <?php include('footer.php');?>
  <script type="text/javascript" src="js/cartel.js"></script>
</body>
</html>
