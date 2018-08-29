<?php
include('header.php');

$id= $verificar->id();
//solo hay que validar si la tarjeta es valida.. que complete DNI.. NOMBRE APELLIDO... CLAVE DE LA TARJETA, number DE LA TARJETA


//-----------------------------------------------
//consulta para que un coplito nose vuelva a postular a un viaje donde fue aceptado pero se dio de baja 

/*$consulta="SELECT * FROM calificacion WHERE usuario_id=$id AND es_sancion=1 and viaje_id=$_GET[id_viaje] and cumple=1";
$resul=mysqli_query($link,$consulta);

if (mysqli_num_rows($resul)>0) {
  $_SESSION['mensaje'] = "ERROR: Lo siento, no se puede volver a postular...Usted ya se postulo anteriormente, fue aceptado y se dio de baja";
    header("Location: inicio.php");
    die();
}*/

	/*$fecha_actual = date('Y-m-d');
	
	//resto 30 días de la fecha actual
	$fecha_actual=date("Y-m-d",strtotime($fecha_actual."- 30 days"));
	$chequeo_viajes="SELECT v.fecha FROM calificacion c INNER JOIN viajes v on(c.viaje_id=v.id) WHERE (c.calificador_id=$id and v.fecha < '$fecha_actual' and c.cumple=0) OR (c.calificador_id=$id and v.fecha <= '$fecha_actual' and c.cumple=0 and v.activo=3) ";	


	//realizo la consulta
	$resul=mysqli_query($link,$chequeo_viajes);
	//echo mysqli_num_rows($resul);
	if (mysqli_num_rows($resul)>0) {
		$_SESSION['mensaje']="Usted adeuda calificaciones, de hace mas de de 30 dias";
		header("Location: inicio.php");
		die();
	}*/

  $chequeo_viajes="SELECT c.viaje_id, v.fecha FROM calificacion c INNER JOIN viajes v on(c.viaje_id=v.id) where  c.calificador_id=$id AND c.cumple=0 AND c.es_sancion=0 ";  
  #echo $chequeo_viajes;
  //realizo la consulta
  $resul=mysqli_query($link,$chequeo_viajes);
  //echo mysqli_num_rows($resul);
  while ($fechas=mysqli_fetch_array($resul)) {
  $fecha1 = new dateTime($fechas['fecha']);
  $fecha2 = new dateTime(date("Y-m-d"));
  $diferencia = $fecha1->diff($fecha2);
  if ( $diferencia->days > 30){
    $_SESSION['mensaje'] = "Usted adeuda calificaciones, de hace mas de de 30 dias";
      header("Location: inicio.php");
      die();
  }
    
  }


$fecha_actual=date('Y-m-d');
	$date = new DateTime($fecha_actual);

	$date->modify("next Monday");//avanzo al siguiente dia

	$fecha=$date->format('Y-m-d');
?>
<p style="font-size: 1.3em;background-color:rgba(255, 255, 255, 0.5);" class="color-a" >Realizar Pago: </p>
<div class="container">
<form class="f1_pago" id="validar_tarjeta" method="POST" action="alta_postulacion.php">

<div class="form-group">
  <div class="row">
    <div class="col-xs-6">
      <b class="color-a " >Datos de la tarjeta</b>

    </div>
    <div class="col-xs-6">
      <b class="color-a " >Datos del titular</b>
    </div>
  </div>
</div>    
<div class="form-group">
  <div class="row">
    <div class="col-xs-6">

      <label >Nro de tarjeta: </label>
      <span id="error_nro_tarjeta" class="error"></span>
      <input class="input-f1  focus_azul" id="nro_tarjeta" type="text" pattern="[0-9]{16}" title="complete con un numero de 16 digitos numericos" value="1234567812345678" >

    </div>
    <div class="col-xs-6">

      <label >Nombre: </label>
      <span id="error_nombre" class="error"></span>
      <input class="input-f1 focus_azul" id="nombre" type="text" value="Ines">

    </div>
  </div>
</div>
  <!-- - - - - - -->
<div class="form-group">
  <div class="row">
    <div class="col-xs-6">

      <label >Clave de seguridad: </label>
      <span id="error_clave" class="error"></span>
      <input class="input-f1 focus_azul" type="password" name="clave" id="clave" min="0" value="1234">


    </div>
    <div class="col-xs-6">
      <label >Apellido: </label>
      <span id="error_apellido" class="error"></span>
      <input class="input-f1 focus_azul" id="apellido" type="text" value="Mendez">
    </div>
  </div>
</div>
  <!-- - - - - - - - - ---->
<div class="form-group">
  <div class="row">
    <div class="col-xs-6">

      <label  for="">Fecha de vencimiento:</label>
      <span id="msj_fecha" class="error" ></span>
      <input id="fecha" class="input-f1 focus_azul" type="date" value="<?php echo $fecha ?>">

    </div>
    <div class="col-xs-6">
     <label >DNI: </label>
      <span id="error_dni" class="error"></span>
      <input class="input-f1 focus_azul" type="text" pattern="[0-9]{8}" title="complete con un numero de 8 digitos numericos" name="clave" id="dni" value="42952824">
    </div>
  </div>
  <input type="hidden" name="id_viaje" value=" <?php echo $_GET['id_viaje']; ?>">

      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
</div>
  <!-- - - - - - -->
<div class="form-group">
  <div class="row">
    <div class="col-xs-6">

     <button  class=" btn btn-primary "  type="submit">Enviar</button>
    </div>
    <div class="col-xs-6">
      <a class=" btn btn-danger " style="background-color:#CB030E;float: right;"  href="inicio.php">Cancelar</a>
    </div>
  </div>
</div>
  <!-- - - - - - - - - ---->


  </form>
</div>

<?php
include('footer.php');

mysqli_close($link);
?>
<script type="text/javascript" src="js/validar_tarjeta.js"></script>
</body>
</html>