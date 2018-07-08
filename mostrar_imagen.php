<?php
    include('conexion.php');
	$link=conectar();//el link toma ES LA BASE DE DATOS DORAIGA

    $idimage=$_GET['id'];
	//-----------------------
	 $sql3="select contenidoimagen,tipoimagen
	 		FROM usuarios
	 		WHERE id=$idimage";
	

	$result = mysqli_query($link, $sql3);
	$row = mysqli_fetch_array($result);
	mysqli_close($link);

	header("Content-type: ". $row['tipoimagen']);
	echo $row['contenidoimagen'];

?>