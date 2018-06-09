<?php
include('header.php');
$viajes="SELECT * FROM viajes ";//consulta de viajes

$sql2="";
$parametro="";
if(isset($_GET["pag"])){
			$pag=$_GET["pag"];
			$pag_actual=$_GET["pag"];;
			$pag=(($pag -1) * 5);//cantidad de viajes a mostros
			$otra = $sql2;
			$sql2.=" LIMIT $pag,5 ";

		} else{
			$pag_actual=1;
			$otra = $sql2;//limitador de la cantidad de viajes a mostrar
			$sql2.=" LIMIT 0,5 ";
			}
			$resul=mysqli_query($link,$viajes.$sql2);
?>

<section>

	<?php 
	$mostrar=mysqli_num_rows($resul);
	if ($mostrar ==0) {
		echo "Por el momento no hay viajes, disculpe las molestias";
	}else{
		while ($mostrar=mysqli_fetch_array($resul)) { ?>
			<article>
				<p>Origen: <?php echo $mostrar['origen']; ?></p>
				<p>Destino:<?php echo $mostrar['destino']; ?></p>
				<p>Fecha: <?php echo $mostrar['fecha']; ?></p>
				<p>Hora: <?php echo $mostrar['horario'];?>Hs</p>
				<p>Asientos: <?php echo $mostrar['copilotos']; ?></p>
			</article>
			<br><br>

		<?php } }?>

</section>
<section>
	<?php 

	$sql_pag= "SELECT COUNT(id) AS numero FROM viajes p ".$otra;
			$resul= mysqli_query($link,$sql_pag);
			$pagina=mysqli_fetch_array($resul);
			$total_pag= ceil( $pagina["numero"] / 5);
			//echo $pagina["numero"]."<br>";
			//echo $total_pag;

			if ($total_pag > 1) {

			 $nextpage= $pag_actual +1;
			 $prevpage= $pag_actual -1;	?>
			 <ul class="pagination">
			 <?php 

			 if($pag_actual > 1) {?>
			 
					  <li>
						<a href="inicio_2.php?<?php echo $parametro."pag=".$prevpage;?>">«Anterior </a>
					</li>
					<?php } ?>
			<li><a class="active" href="#"><?php echo $pag_actual;?></a></li>
		 	<?php
		 	 if ($pag_actual != $total_pag) { ?>
			 	<li>
			 		<a href="inicio_2.php?<?php echo $parametro."pag=".$nextpage;?>">Siguiente»</a></li>
			 </ul>
			<?php }
			 ?>
			 
			 <?php  }?>
			
</section>

<?php
include('footer.php');
 ?>