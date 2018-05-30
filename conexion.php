<?php

// archivo conexion.php
function conectar(){
$link = mysqli_connect('localhost', 'root','', 'aventon');
//mysqli_set_charset($link,"utf8");
return $link;
}

?>