function limpiar_errores() {
	document.getElementById('error_marca').innerHTML="";
	document.getElementById('error_patente').innerHTML="";
	document.getElementById('error_modelo').innerHTML="";
	document.getElementById('error_asientos').innerHTML="";

	document.getElementById('marca').classList.remove('error_border');
	document.getElementById('patente').classList.remove('error_border');
	document.getElementById('modelo').classList.remove('error_border');
	document.getElementById('asientos').classList.remove('error_border');
	
}

function validar_marca(){
	var marca = document.getElementById('marca');
	limpiar_errores();

	if (!marca.value){
		document.getElementById('error_marca').innerHTML="campo incompleto";
		marca.classList.remove('focus_azul');
		marca.classList.add('error_border');
		marca.focus();
		alert("Error: campo Marca incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_patente(){
	limpiar_errores();
	var patente = document.getElementById('patente');
	if (!patente.value){
		document.getElementById('error_patente').innerHTML="campo incompleto";
		patente.classList.remove('focus_azul');
		patente.classList.add('error_border');
		patente.focus();
		alert("Error: campo Patente incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_modelo(){
	var modelo = document.getElementById('modelo');
	limpiar_errores();
	if (!modelo.value){
 		document.getElementById('error_modelo').innerHTML="campo incompleto";
		modelo.classList.remove('focus_azul');
		modelo.classList.add('error_border');
		modelo.focus();
		alert("Error: campo Modelo incompleto, por favor complete el campo.");
		return false;
 	}
 	return true;
}
function validar_cantAsientos(){
	limpiar_errores();
	var cantAsientos = document.getElementById('asientos');
	if (!cantAsientos.value){
		document.getElementById('error_asientos').innerHTML="campo incompleto";
		cantAsientos.classList.remove('focus_azul');
		cantAsientos.classList.add('error_border');
		cantAsientos.focus();
		alert("Error: campo Asientos incompleto, por favor complete el campo.");
		return false;
 	}
 	if (!/^([2-9])*$/.test(cantAsientos.value)){
 		document.getElementById('error_asientos').innerHTML="el numero de asiento debe ser mayor o igual 2";
		cantAsientos.classList.remove('focus_azul');
		cantAsientos.classList.add('error_border');
		cantAsientos.focus();
		alert("Error: campo Asientos, recuerde que con la cantidad de asientos se va a calcular el costo de los viajes.");
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