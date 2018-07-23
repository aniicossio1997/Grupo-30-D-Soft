<?php 
include('PHPMailer/PHPMailerAutoload.php');
include('conexion.php');
$link=conectar();
session_start();

 ?>

<?php 
//-- si la varible email pasado como parmetro no exite o esta vacia --
if (!isset($_POST['email']) || empty($_POST['email'])) {
	$_SESSION['error']="El email esta vacio";
	header("location:recuperar_clave.php");
	//echo $_POST['email'];
	die();
}

$email=$_POST['email'];
//-------------------------------
$consulta="SELECT password FROM usuarios WHERE email='$email'";
$resul=mysqli_query($link,$consulta);

if (mysqli_num_rows($resul)==0) {
	$_SESSION['error']="El email no existe, intentelo de nuevo";
	header("location:recuperar_clave.php");
	die();
}
$mostrar=mysqli_fetch_array($resul);
$password=$mostrar['password'];
echo $mostrar['password'];
echo '$email';
//die();

//------------------------
$mail=new PHPMailer();

$mail->isSMTP();

$mail->SMTPOptions = array(
 'ssl' => array(
  'verify_peer' => false,
  'verify_peer_name' => false,
  'allow_self_signed' => true
 ));


$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Host='smtp.gmail.com';
$mail->Port='587';
$mail->Username='aventonsoporte@gmail.com';
$mail->Password='AvEnToN123';

$mail->setFrom('aventonsoporte@gmail.com','Equipo de Soporte Aventon');
$mail->addAddress("$email");

$mail->Subject='Recuperar Password';
$mail->Body='<br><br><b>Su contraseña es: </b>'.$password;

$mail->IsHTML(true);



if ($mail->send()) {
	echo "enviado";
	$_SESSION['bien']="Se ha enviado un mensaje de recuperación de contraseña a su correo electrónico";
	header("location:recuperar_clave.php");
	die();
}else{
	$_SESSION['error']="ERROR: no sea podido realizar la operación, intentelo más tarde";
	header("location:recuperar_clave.php");
	die();
}





 ?>



<?php 

 ?>