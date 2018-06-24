<?php 


  include ('header.php');
  $id = $verificar->id(); 


  $viajes = "SELECT vj.id,vi.usuario_id,vj.horario,vj.tipo,vj.activo,vj.copilotos,vj.costo,vj.duracion,vj.descripcion,vj.destino,vj.fecha,vj.tipo,vj.origen, vj.vehiculo_id FROM vehiculo vi  INNER JOIN usuarios u ON (vi.usuario_id=u.id)  INNER JOIN viajes vj ON (vj.vehiculo_id=vi.id) WHERE vi.usuario_id=$id order by vj.id desc " ;
  $datos=mysqli_query($link,$viajes);


?>

  <h1 class="h1-form">Mis viajes como Piloto </h1>
<div class=" div_incio" style="margin-top: 4%; width: 80%">
 <?php while ($vector =mysqli_fetch_array($datos) ) { 





 	?> 

	<article class="article_exterior">
      <article class="article_interior" style="margin-top: 0%">
        <div style="width: 100%; display: inline-block; ">
        <div style="width: 50%;">

          <div style="width: 30%;  float: left;">
		        <p  class="p-perfil p-left" style="font-style: italic;">Fecha:<?php echo $vector['fecha'] ?></p>
			    <p class="p-perfil p-left" style="font-style: italic;">Origen: <?php echo ($vector['origen']); ?>
				</p>
		        <p  class="p-perfil p-left"  style="font-style: italic;">Destino: <?php echo ($vector['destino']); ?> </p>	
		        <p  class="p-perfil p-left" style="border:5 solid pink;" style="font-style: italic;">Hora: <?php echo ($vector['horario']); ?> Hs
		    	</p>		        					        
           </div>
          </div>
        <div style="width: 30%; margin-left:  30%">
                  <p  class="p-perfil p-left" style="font-style: italic;">Duracion: <?php echo ($vector['duracion']); ?>
		    	 </p>
		    	<p class="p-perfil p-left" style="font-style: italic;">Precio: $<?php echo (round($vector['costo'] / ($vector['copilotos'] + 1))); ?>		
		    		</p>
		    		<p class="p-perfil p-left" style="font-style: italic;">Tipo de viaje: <?php echo ($vector['tipo']); ?>		
		    		</p>		    	 
        </div>
      </div>
      </article>
      <div style="margin-top: 1%">
      	<a style="margin-left: 0.5%" class="a-link2 fondo-blue" href="detalle_viaje.php?id_viaje=<?php echo $vector['id'] ?>">Detalle</a>
      </div>
      <div style="margin-top: 1%">
        <a style="margin-left: 0.5%" class="a-link2 fondo-blue"  href="modificar_viaje.php?id_vehiculo=<?php  echo $vector['vehiculo_id'];?>&id_viaje=<?php echo $vector['id']; ?> ">Modificar</a>
      </div>
      </article>
 <?php }

 ?>
 </div>

 <?php include('footer.php');?>
</body>
</html>
