<?php 




?>
	<form id="form1" action="p1.php">
		<input id="patente" type="text" name="patente">
		<input type="submit" value="enviar">
	</form>
	<script type="text/javascript">
		function validar() {
			var patente=document.getElementById("patente");
			var exp_pat=/^[A-Z]{2}[0-9]{3}[A-Z]{2}/;

			if (!exp_pat.test(patente.value)) {
				alert("no es corecto");
				return false;
			}
			return true;

			
		}
		window.onload = function(){

		document.getElementById('form1').onsubmit=validar;
	}
	</script>