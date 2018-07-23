<?php include('header.php'); 

if ($verificar->esta_logueado()){
	header("Location:inicio.php");
}

?>

<!--  - - - - - - - - - - - - - - - - - -  -->

<?php  if (isset($_SESSION['error']) ){ ?>
	<script type="text/javascript">
		activar_modal();
	</script>

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #D50404;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="color: #fff; text-align: center;">Se ha producido un error</h3>
      </div>
      <div class="modal-body" style="color: #fff; border: none;">
        <p style="text-align: center;"><?php echo $_SESSION['error']; ?></p>
      </div>
      <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php  unset($_SESSION['error']); }  ?>
<!-- - - - - - - - -  - - - - - - - - - ---->
<!-- - - - - - - - -  - - - - - - - - - ---->
<?php  if (isset($_SESSION['bien']) ){ ?>
	<script type="text/javascript">
		activar_modal();
	</script>

	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #199D05;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="color: #fff; text-align: center;">Operación exitosa</h3>
      </div>
      <div class="modal-body" style="color: #fff; border: none;">
        <p style="text-align: center;"><?php echo $_SESSION['bien']; ?></p>
      </div>
      <div class="modal-footer" style="border:none;">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php  unset($_SESSION['bien']); }  ?>







<div class="container " style="width: 75%" >
	<h1 class="h1-form">Recuperar contraseña

	</h1>

<div class="conteiner-f1">
	<form class="conteiner" id="form_rec" action="validar_recuperacion.php" method="POST" style="margin-bottom: -3%" >		
		<div style="margin-top: 2%">
			<label for="email">Email:</label>
			<span id="error_email" class="error"></span>
			<br>
			<input type="email" id="email" class="input-f1 focus_azul " name="email" placeholder="escriba un correo para continuar">
			<br>
		</div>
		<br>
		<button  class="btn btn-success" type="submit">Continuar</button>
		<p style="text-align: center;">¿Usted no posee una cuenta? click <a href="registrarse.php" class="color-a">AQUÍ</a></p>
		
	</form>
</div>
</div>



<?php 

include('footer.php');
 ?>
 <script type="text/javascript" src="js/validar_recuperacion.js"></script>


</body>
</html>