<?php 
function edad($fecha)
{
	$cumpleanos = new DateTime($fecha);
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    echo $annos->y;
}
    
     ?>