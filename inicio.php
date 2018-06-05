<?php
 include('header.php'); 
 $id = $verificar->id(); //obtengo la id del usuario que inicio la sesion 
 $consulta= ("SELECT * FROM viajes");
 $resultado = mysqli_query($link, $consulta);
?>

 <?php
 while ($fila = mysqli_fetch_array($resultado)) {?>
 	<article class="mis_vehiculos"><p class="text_center">
	  <article class="mis_vehiculos">	
		<table class="tabla" >
			<tr>
				<td class="td-p">
					<p class="p-perfil p-left">Origen: <?php echo ($fila['origen']); ?>
					</p>
				</td>
		   	 	<td  class="td-p">
		    	 	<p class="p-perfil p-left ">Destino: <?php echo ($fila['destino']); ?>
		    	 		
		    	 	</p>
		    	</td>
		    	<td class=" td-a "> 
		    		<a  class="a-link2 a-rig fondo-blue" href="">Postularse 
		    		</a>
		    	</td>		   
		    </tr>
		    <tr>		    
		    	<td class="td-p"> 
		    		<p class="p-perfil p-left ">Precio: <?php echo ($fila['costo']); ?>
		    			
		    		</p>
		    	</td>

		    	<td class="td-p"> 
		    		<p class="p-perfil p-left "> </p>
		    	</td>

		    	<td class="td-a">
		    		<a class="a-link2 a-rig fondo-blue" href="">Detalles 
		    		</a>
		    	</td>
		    </tr>

		</table>
	</article>
	</p>

	</article>
<?php
}
include('footer.php');
 ?>