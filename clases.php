<?php 
class validar{
	private $link;//es mi variable de instancia accedo a esta varible con this

	function __construct($link){
		$this->link=$link;
	}
	function logueado(){

		if(!isset($_SESSION['id'])){
			throw new Exception("error");
		}//guarda una exepcion
	}
	function esta_logueado(){
		if (isset($_SESSION['id'])) {
			return true;
		}else return false;
		
	}

	
	function id(){
		if (isset($_SESSION['id'])) {
			return ($_SESSION['id']);
		}
		else "";
	}

	function autenticar($usuario,$clave){
		 $sql="SELECT * FROM usuarios  WHERE email='$usuario' AND password='$clave'";
		 $result= mysqli_query($this->link, $sql);
		 $rows=mysqli_num_rows($result);

			if($rows!=0){//si existe el usuario y la contraseña

			$row=mysqli_fetch_assoc($result);
			$_SESSION['id']=$row['id'];//GUARDO EL ID DEL USUARIO
			$_SESSION['nombreusuario']=$row['nombreusuario'];
		}
		else{
			throw new Exception("error");
			
		}
	}



}

?>