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
		}else{return false;} 
		
	}
	function nombre(){
		if (isset($_SESSION['nombre'])) {
			return ($_SESSION['nombre']);
		}else{
			return "";} 
		
	}

	
	function id(){
		if (isset($_SESSION['id'])) {
			return ($_SESSION['id']);
		}
		else "";
	}
	function existe_user($usuario){
		$consulta="SELECT password FROM usuarios WHERE email='$usuario'";
		$resul=mysqli_query($this->link,$consulta);
		if (mysqli_num_rows($resul)!=0) {
			$mostrar=mysqli_fetch_array($resul);
			return $mostrar['password'];
		}
		return false;
		
	}

	function autenticar($usuario,$clave){
		 $sql="SELECT * FROM usuarios  WHERE email='$usuario' AND password='$clave' AND activo =1";
		 $result= mysqli_query($this->link, $sql);
		 $rows=mysqli_num_rows($result);

			if($rows!=0){//si existe el usuario y la contraseña

			$row=mysqli_fetch_assoc($result);
			$_SESSION['id']=$row['id'];//GUARDO EL ID DEL USUARIO
			$_SESSION['nombre']=$row['nombre'];
		}
		else{
			throw new Exception("error");
			
		}
	}



}

?>