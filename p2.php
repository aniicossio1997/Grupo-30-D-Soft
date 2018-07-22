<?php 
include('PHPMailer/PHPMailerAutoload.php');
include('conexion.php');
$link=conectar();
session_start();
include('clases.php');
$verificar = new validar($link);//se crea  una clase
$id=$verificar->id();
 ?>

<?php 
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
$mail->Password='H0l@123456';

$mail->setFrom('aventonsoporte@gmail.com','Equipo de Soporte Aventon');
$mail->addAddress('onlyhoman7@gmail.com');

$mail->Subject='-------Recuperar Password----------';
$mail->Body='<br><br><b>Tu contraseña es: </b>';
$mail->IsHTML(true);



if ($mail->send()) {
	echo "enviado";
}else{
	echo "error";
}





 ?>



<?php 

 ?>