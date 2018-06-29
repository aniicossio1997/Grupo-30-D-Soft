<?php
// archivo conexion.php
function conectar(){
$link = mysqli_connect('localhost', 'root','', 'aventon');
return $link;
}
?>