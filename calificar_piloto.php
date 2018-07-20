<?php 
include('header.php');


$consulta="SELECT nombre, apellido,fecha_nac,id FROM usuarios WHERE id=$_GET[user_a_cal]";
$resul=mysqli_query($link,$consulta);
$fila=mysqli_fetch_array($resul);


?>


<form id = "calificar" action="validar_calificar.php" method="POST" style="margin: 0% auto;width:80%">
<div class="caja_cal_pil fondo_gris" style="background-color:rgba(255, 255, 255, 0.5);">
  
  <p> <span class="color-a">Calificar a: </span><?php echo $fila['nombre'].",".$fila['apellido']; ?> </p> 
  <div >
    <label for="puntaje">Puntaje:</label>
    <span id="error_puntaje" class="error"> </span>
    <br>
      <select name= "puntaje" id="puntaje">
        <option value="">Eligir opciones</option>
        <option  value="neutro">neutro</option>
        <option value="malo">malo</option>
        <option value="bueno">bueno</option>
      </select>
  </div>
  <?php //-----------------------------------------------------------------------------------------------------------
   ?>
  <div>
    <input type="hidden" name="user_a_cal" value="<?php echo $_GET['user_a_cal'] ?>">
    <input type="hidden" name="id_cal" value="<?php echo $_GET['id_cal'] ?>">
       <label for="comentario">Comentario:</label>
       <span id="error_comentario" class="error"> </span>
       <br>
      <textarea id="comentario" style="width: 90%"  name="comentario" class="focus_azul"></textarea>
  
  </div>
  <?php //----------------------------------------------------------------------------------------------------------
   ?>
   <br>
   <button class="btn btn-primary" type="submit" name="enviar" id="enviar">Guardar</button>
</div>
</form>
<?php //-----------------------------------------------------------------------------------------------------------
 ?>


</div>

<br>
<br>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_calificar_copiloto.js"></script>
</body>
</html> 