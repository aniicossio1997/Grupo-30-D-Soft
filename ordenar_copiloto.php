<?php
if (isset($_GET['filtro'])) {
	if (isset($_GET['tipos']) && $_GET['tipos']|='' && $_GET['tipos']!="0") {
		$sql2.=" AND p.estado =".$_GET["tipos"];
			$parametro.= "tipos=".$_GET['tipos']."&";
	}



}
?>

<form action="mis_viajes.php" method="GET">
ver viajes:
<select name="tipos">
	<option value="0">----</option>
	<option value="acep">Aceptado</option>
	<option value="esp">En espera</option>
	<option value="rech">Rechazado</option>
</select name="">
Ordenar por Fecha:
<select name="fecha">
	<option value="0">----</option>
	<option value="fecha_asc">Ascedente</option>
	<option value="fecha_desc">Desentente</option>
</select>
Ordenar por Origen:
<select name="origen">
	<option value="0">----</option>
	<option value="origen_asc">Ascedente</option>
	<option value="origen_desc">Desentente</option>
</select>
Ordenar por Destino:
<select name="destino">
	<option value="0">----</option>
	<option value="destino_asc">Ascedente</option>
	<option value="destino_desc">Desentente</option>
</select>
<button name="filtro" type="submit" >Aplicar</button>
</form>