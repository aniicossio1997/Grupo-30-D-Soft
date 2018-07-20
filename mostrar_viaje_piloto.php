<?php 


  include ('header.php');

  $id = $verificar->id(); 


  $viajes = "SELECT vj.id,vi.usuario_id,vj.horario,vj.tipo,vj.activo,vj.copilotos,vj.costo,vj.duracion,vj.descripcion,vj.destino,vj.fecha, vj.minutos,vj.tipo,vj.origen, vj.vehiculo_id FROM vehiculo vi  INNER JOIN usuarios u ON (vi.usuario_id=u.id)  INNER JOIN viajes vj ON (vj.vehiculo_id=vi.id) WHERE vi.usuario_id=$id and vj.activo<>2 order by vj.fecha, vj.horario asc " ;

$parametro=" ";//Guarda los parametros recibidos para la siguiente pagina
$sql2=" ";

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










  $datos=mysqli_query($link,$viajes.$sql2);

?>



<div class=" fondo_gris">
    <p class="title_fv color-a ">Mis creados/viajes como Piloto
</p">
</div>
<?php /*<div style="; box-sizing: border-box; float: right; margin-right: 7%" >
    <a style="position: fixed;" class="a-link2 fondo-blue" href="<?=$_SERVER["HTTP_REFERER"]?>">Volver</a>
 </div> */ ?>



<div class=" div_incio" style="margin-top: 4%; width: 85%">
  <?php if (mysqli_num_rows($datos) < 1) {
    echo "~~No hay resultados o usted no posee viajes creados~~";
  } ?>
 <?php while ($vector =mysqli_fetch_array($datos) ) { 
   if ($vector['activo'] != 2) {
   
 	?> 


       <?php

if (isset($_SESSION['mensaje'])) { ?>
  <div class="cartel div-externo"  id="cartel">
    <div class="div-interno " style="margin-top: 10%; padding: 2%;">
        <p style="text-align: center; color: white; font-style: italic;"><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?> </p>
      </div>
      <div class="div-bttn-ok"">
        <a class="a-link2  fondo-blue " style="margin-left: 1%; margin-top: 0%;" id="cerrar" href=""> Ok</a>
      </div>
  </div>
<?php } ?>
      


	<article class="article_exterior" style="box-sizing: border-box; width: 97%">
      <article class="article_interior"style="margin-top: 0%; border: 1px solid #ccc; width: 100%; box-sizing: border-box;">

        <table class="table" style="font-style: italic;">
          <tbody>
            <tr>
              <td>Origen: <?php echo ($vector['origen']); ?></td>
              <td>Destino: <?php echo ($vector['destino']); ?></td>
              <td>Fecha: <?php echo fecha_string ($vector['fecha']); ?></td>
            </tr>
            <tr>
              <td>Hora: <?php 
                 echo substr("$vector[horario]", 0, -3)."hs"; ?>
              </td>
              <td>
                Duración:<?php echo $vector['duracion']."hs - ".$vector['minutos']." minutos"; ?>
              </td>
              <td>Precio: $<?php echo (floor($vector['costo'] / ($vector['copilotos'] + 1))); ?>    </td>
            </tr>
          </tbody>
        </table>

      </article>
      <div style="margin-top: 1%;line-height: 1.4em;" class="cursor">
      	<a style="margin-left: 0.5% cursor: pointer;" class="a-link2 fondo-blue " href="detalle_viaje.php?id_viaje=<?php echo $vector['id'] ?>&detalle<?php echo "1" ?>">Detalle</a>
      </div>
      <div style="margin-top: -2.7%;margin-left: 3%;">
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
 <!-- - - - - - - - - - - - -->

 <?php 
  //-------------PAGINADO-------------------------

  $sql_pag= ("SELECT COUNT(vj.id) as numero  FROM vehiculo vi  INNER JOIN viajes vj ON (vj.vehiculo_id=vi.id) WHERE vi.usuario_id=$id and vj.activo<>2 ");

      $resul= mysqli_query($link,$sql_pag.$otra);
      $pagina=mysqli_fetch_array($resul);
      $total_pag= ceil( $pagina["numero"] / 5);
      #echo $pagina["numero"]."<br>";
      #echo $total_pag."<br>";
      if ($total_pag > 1) {
        if ( !isset($_GET['pag'])) {
          $pag_actual=1;
        }
        $nextpage= $pag_actual +1;
        $prevpage= $pag_actual -1; ?>
        <br>
      <div class="container" style="width: 87%">
      <ul class="pagination" style="width: 100%">

        <?php
        if ($pag_actual !=1 && $pag_actual!=0) { ?>
          <li class=""><a style="float: left;" href="mostrar_viaje_piloto.php?<?php echo $parametro."pag=1";?>">1er pagina</a></li>
        <?php  }

        if ($pag_actual >1) { ?>
          <li class="next"><a href="mostrar_viaje_piloto.php?<?php echo $parametro."pag=".$prevpage;?>">&larr; Anterior</a></li>

        <?php  } ?>
        <li><a class="active" href="#"><?php echo $pag_actual;?></a></li>

        <?php
        if ($pag_actual <$total_pag) { ?>
          <li class=""style="float: right;" ><a href="mostrar_viaje_piloto.php?<?php echo $parametro."pag=".$total_pag;?>">Ultima pagina</a></li>
        <?php }
        ?>

        <?php
        if ($pag_actual <$total_pag) { ?>
          <li class="" style="float: right; margin-right: 0.5%"><a href="mostrar_viaje_piloto.php?<?php echo $parametro."pag=".$nextpage;?>">Siguiente &rarr;</a></li>
        <?php }
        ?>


        </ul>
        <p style="color: #777">Total de paginas <?php echo $total_pag; ?></p> 
        </div>
      <?php }
      
      ?>


 <?php include('footer.php');?>
  <script type="text/javascript" src="js/cartel.js"></script>
</body>
</html>
