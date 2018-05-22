<?php
	session_start();
	include('conexion.php');
	$link=conectar();

	include('clases.php');
	$verificar = new validar($link);
	$id_user = $verificar->id();


	if($_FILES['foto']['size']>0){

			$type= addslashes($_FILES['foto']['type']);//Obtenego el la ruta del archivo en forma de string
			if ($type!="image/png" && $type!="image/jpg" && $type!="image/jpeg" & $type!="image/gif" && $type!="image/bmp" && $type!="image/tif") {
				$_SESSION['mensaje']="El archivo no es una imágen";
				header("Location:mi_perfil.php");
				die("fin");
			}	
			$image = addslashes (file_get_contents($_FILES['foto']['tmp_name']));
			$consulta="UPDATE usuarios SET tipoimagen = '$type', contenidoimagen = '$image' WHERE id = $id_user";
			//echo "exito";
			$resul=mysqli_query($link,$consulta);
			if ($resul) {
				$_SESSION['mensaje']="Imagen guardada con exito ";
				header("Location:mi_perfil.php");
				die("salir");	
			}else{$_SESSION['mensaje']="No se pudo realizar con exito el guardado de la foto ";
				header("Location:mi_perfil.php");
				die("salir");	}
			
	}else{
		$_SESSION['mensaje']="No existe ninguna imagen asociada, seleccione una imagen";
		header("Location:mi_perfil.php");
		die("salir");
	}
	mysqli_close($link);

 ?>