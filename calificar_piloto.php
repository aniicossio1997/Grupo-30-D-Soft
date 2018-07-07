<?php 
include('header.php');

?>

<form id = "calificar" action="validar_calificar_piloto.php" method="POST" style="margin: 0% auto;width:80%"> <h1 class ="h1_form color-a"> Calificar Piloto</h1> 
<div >
  <label for="puntaje">Puntaje:</label>
  <span id="error_puntaje" class="error"> </span>
  <br>
    <select name= "puntaje" id="puntaje">
      <option>Eligir opciones</option>
      <option>neutro</option>
      <option>malo</option>
      <option>bueno</option>
    </select>
</div>
<?php //-----------------------------------------------------------------------------------------------------------
 ?>
<div>
     <label for="comentario">Comentario:</label>
     <span id="error_comentario" class="error"> </span>
     <br>
    <textarea id="comentario" style="width: 50%" id= "comentario" name="comentario" class="focus_azul"></textarea>

</div>
<?php //----------------------------------------------------------------------------------------------------------
 ?>
 <button type="submit" name="enviar" id="enviar">Guardar</button>

</form>
<?php //-----------------------------------------------------------------------------------------------------------
 ?>

<a href="validar_calificar_copiloto.php">ver</a>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/validar_calificar_piloto.js"></script>
</body>
</html> 
