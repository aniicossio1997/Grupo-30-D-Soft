function limpiar_errores(){
	document.getElementById('error_comentario').innerHTML=" ";
	document.getElementById('error_puntaje').innerHTML=" ";

}

function validar_comentario(){
	var coment = document.getElementById('comentario');
	limpiar_errores();
	if (!coment.value){
		document.getElementById('error_comentario').innerHTML="Falta completar el campo comentario, ingrese uno";
		coment.focus();
		alert("Error: campo Comentario incompleto.");
		return false;
	}
	return true;
}



function validar_puntaje(){
	var puntaje = document.getElementById('puntaje');
	limpiar_errores();
	if(puntaje.selectedIndex ==0){
		puntaje.focus();
		document.getElementById('error_puntaje').innerHTML="Falta seleccionar un puntaje, seleccione uno";
	    
	    alert("Error : campo  Puntaje incompleto");
	    return false;
	}
	return true;

}

function validar(){
	if( validar_puntaje() && validar_comentario()){
		return true;
	}
    return false; 
}
window.onload = function() {

	
   document.getElementById('calificar').onsubmit=validar;

	}