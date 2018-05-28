function validar_marca(){
	var marca = document.getElementById('marca');
	document.getElementById('error_marca').innerHTML="";
	if (!marca.value){
		document.getElementById('error_marca').innerHTML="campo incompleto";
		marca.focus();
		alert("Error: campo Marca incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_patente(){
	var patente = document.getElementById('patente');
	document.getElementById('error_patente').innerHTML="";
	if (!patente.value){
		document.getElementById('error_patente').innerHTML="campo incompleto";
		patente.focus();
		alert("Error: campo Patente incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_modelo(){
	var modelo = document.getElementById('modelo');
	document.getElementById('error_modelo').innerHTML="";
 	if (!modelo.value){
 				document.getElementById('error_modelo').innerHTML="campo incompleto";
		modelo.focus();
		alert("Error: campo Modelo incompleto, por favor complete el campo.");
		return false;
 	}
 	return true;
}
function validar_cantAsientos(){
	var cantAsientos = document.getElementById('asientos');
	document.getElementById('error_asientos').innerHTML="";
 	if (!cantAsientos.value){
		document.getElementById('error_asientos').innerHTML="campo incompleto";
		cantAsientos.focus();
		alert("Error: campo Asientos incompleto, por favor complete el campo.");
		return false;
 	}
 	return true;
}
function validar(){
	if(validar_marca() && validar_patente() && validar_modelo() &&	validar_cantAsientos()){
	  return true;
	}
	return false;
}

window.onload = function(){
	document.getElementById('form1').onsubmit = validar;

}