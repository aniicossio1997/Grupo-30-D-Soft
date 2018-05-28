function validar_nombre() {
	var nombre = document.getElementById('nombre');
	document.getElementById('error_nombre').innerHTML="";
	if (!nombre.value){
		document.getElementById('error_nombre').innerHTML="campo incompleto";
		nombre.focus();
		alert("Error: campo Nombre incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_apellido() {
	var apellido = document.getElementById('apellido');
	document.getElementById('error_apellido').innerHTML="";
	if (!apellido.value){
		document.getElementById('error_apellido').innerHTML="campo incompleto";
		apellido.focus();
		alert("Error: campo apellido incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_email() {
	var email = document.getElementById('email');
	document.getElementById('error_email').innerHTML="";
	if (!email.value){
		document.getElementById('error_email').innerHTML="campo incompleto";
		email.focus();
		alert("Error: campo email incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_FechaN() {
	var fecha_nac = document.getElementById('fecha_nac');
	document.getElementById('error_fecha_nac').innerHTML="";
	if (!fecha_nac.value){
		document.getElementById('error_fecha_nac').innerHTML="campo incompleto";
		fecha_nac.focus();
		alert("Error: campo fecha_nac incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_pass() {
	var password = document.getElementById('password');
	document.getElementById('error_password').innerHTML="";
	if (!password.value){
		document.getElementById('error_password').innerHTML="campo incompleto";
		password.focus();
		alert("Error: campo password incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_pass2() {
	var password2 = document.getElementById('password2');
	document.getElementById('error_password2').innerHTML="";
	if (!password2.value){
		document.getElementById('error_password2').innerHTML="campo incompleto";
		password2.focus();
		alert("Error: campo password2 incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar(){
   if(validar_nombre() && validar_apellido() && validar_email() && validar_FechaN() && validar_pass() && validar_pass2()){
   	return true;
   }
   return false;
}

window.onload = function(){
  document.getElementById('registro').onsubmit = validar;
}



