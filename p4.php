<?php
include('header.php');
?>

<div class="container">
<form class="f1_pago">

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