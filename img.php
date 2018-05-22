<?php 

    function hay_imagen($id,$link)
    {
    	$sql3="SELECT contenidoimagen,tipoimagen FROM usuarios WHERE id=$id";
	 	$result = mysqli_query($link, $sql3);
	 	if ($result) {
		$row = mysqli_fetch_array($result);

		if ($row['contenidoimagen'] == NULL) {
			
			return false;
			
		}else{ 
		return true;
		}
	}else{
		header("Location:mi_perfil.php");
	}
    }
   
	//-----------------------
	
	
?>