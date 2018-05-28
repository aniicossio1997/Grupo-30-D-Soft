function validar_nombre(){
	var nom = document.getElementById('nombre');
	document.getElementById('error_nombre').innerHTML=" ";
	if (!nom.value){
		document.getElementById('error_nombre').innerHTML="Campo incompleto";
		nom.focus();
		alert("Error: campo Nombre incompleto.");
		return false;
	}
	return true;
}
function validar_apellido(){
	var apellido = document.getElementById('apellido');
	document.getElementById('error_apellido').innerHTML=" ";
	if (!apellido.value){
		document.getElementById('error_apellido').innerHTML="Campo incompleto";
		apellido.focus();
		alert("Error: campo Apellido incompleto.");
		return false;
	}
	return true;
}
function validar_nacimiento(){
	var fecha = document.getElementById('fecha_nac');
	document.getElementById('error_fecha').innerHTML=" ";
	if (!fecha.value){
		document.getElementById('error_fecha').innerHTML="Campo incompleto";
		fecha.focus();
		alert("Error: campo Fecha de nacimiento incompleto.");
		return false;
	}
	return true;
}
function validar_password(){
	var passw1 = document.getElementById('pass1');
	document.getElementById('error_pass1').innerHTML=" ";
	if (!passw1.value){
		document.getElementById('error_pass1').innerHTML="Campo incompleto";
		passw1.focus();
		alert("Error: campo Contraseña incompleto ");
		return false;
	}
	return true;
}
function validar_confirmacion_pass(){
	var passw2 = document.getElementById('pass2');
	document.getElementById('error_pass2').innerHTML=" ";
	if (!passw2.value){
		document.getElementById('error_pass2').innerHTML="Campo incompleto";
		passw2.focus();
		alert("Error: campo Repetir contraseña incompleto");
		return false;
	}
	return true;
}
function validar_contraseñas(){
	if (document.getElementById('pass1') != document.getElementById('pass2')){
		alert("Las claves ingresadas no coinciden")
		return false;
	}
	return true;	
}

function validar(){	
	 if (validar_nombre() && validar_apellido() && validar_nacimiento() && validar_password() && validar_confirmacion_pass() && validar_cant_caracteres() && validar_contraseñas()){
	    	return true;
	 }
	 return false;
	
}
window.onload = function(){
	document.getElementById('form').onsubmit = validar;
}