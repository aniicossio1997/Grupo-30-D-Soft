<?php 


  include ('header.php');
  $id = $verificar->id(); 

  $viajes= "SELECT vi.id,vi.usuario_id,vj.horario,vj.tipo,vj.activo,vj.copilotos,vj.costo,vj.duracion,vj.descripcion,vj.destino,vj.fecha,vj.tipo,vj.origen FROM vehiculo vi  INNER JOIN usuarios u ON (vi.usuario_id=u.id)  INNER JOIN viajes vj ON (vj.vehiculo_id=vi.id) WHERE vi.usuario_id=$id order by vj.id desc " ;

  $datos=mysqli_query($link,$viajes);

  //$vector=mysqli_fetch_array($datos);
?>
  <h1 class="h1-form">Mis viajes como Piloto </h1>
   
   <div  style="background-color:pink;margin-top: 4%">
  <?php while ($vector =mysqli_fetch_array($datos) ) {
  	 ?>
    <div style=" color: black ;background-color:#ff4d4d; margin-top:2%">
     <div style="background-color:#ff4d4d"> 
    <table class="tabla" >  
     	    <tr>
     	    </p>
			  <td >
			     
		        <p  class="p-perfil p-left" style="font-style: italic;">Fecha:<?php echo $vector['fecha'] ?>
		    	</p>
		    	
		      </td>
	   
			  <td class="td-p">
			    <p class="p-perfil p-left" style="font-style: italic;">Origen: <?php echo ($vector['origen']); ?>
				</p>
			  </td>
		   	 
		   	  <td  class="td-p">
		        <p  class="p-perfil p-left"  style="font-style: italic;">Destino: <?php echo ($vector['destino']); ?>
		    	</p>
		      </td>
		      <td  class="td-p">
		        <p  class="p-perfil p-left" style="border:5 solid pink;" style="font-style: italic;">Hora: <?php echo ($vector['horario']); ?>
		    	</p>
		      </td>
              
              
               <td class="td-p" >
                 <p  class="p-perfil p-left" style="font-style: italic;">Duracion: <?php echo ($vector['duracion']); ?>
		    	 </p>
		       </td>
	   		    
		    	<td class="td-p"> 
		    		<p class="p-perfil p-left" style="font-style: italic;">Precio: $<?php echo ($vector['costo']); ?>		
		    		</p>
		    	</td>

		    	<td class="td-p"> 
		    		<p class="p-perfil p-left" style="font-style: italic;">Tipo: <?php echo ($vector['tipo']); ?>		
		    		</p>
		    	</td>
		        
		        </tr>		 
		        <tr>
                
          </table>
	    </article>
	    </article>  
 		</table>
 	</div>  

</div>	  
 <?php }
include('footer.php');
 ?>