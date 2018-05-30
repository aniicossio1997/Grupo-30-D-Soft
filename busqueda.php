<?php include('header.php'); ?>

<form action="" class="form-busqueda">
	<label for="origen">Por:</label>
	<input  class="input-busqueda" type="text" placeholder="origen" id="origen" name="origen">
	<label for="destino">a:</label>
	<input  class="input-busqueda"type="text" placeholder="destino" id="destino" name="destino">

	<label for="precio">Precio</label>
	<input class="input-bn"  type="number" min="0" name="precio1" placeholder="minimo">

	<label for="precio2">a:</label>
	<input class="input-bn"  type="number" min="0" name="precio2" placeholder="maximo">


	<label for="fecha1">De</label>
	<input class="input-busqueda" type="date" id="fecha1" name="fecha1">
	<label for="fecha2">a:</label>
	<input class="input-busqueda" type="date" name="fecha2" id="fecha2">



	<button type="submit">Buscar</button>

</form>