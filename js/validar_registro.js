function limpiar_errores() {

	document.getElementById('error_nombre').innerHTML="";
	document.getElementById('error_apellido').innerHTML="";
	document.getElementById('error_email').innerHTML="";
	document.getElementById('error_fecha_nac').innerHTML="";
	document.getElementById('error_password').innerHTML="";
	document.getElementById('error_password2').innerHTML="";

	document.getElementById('nombre').classList.remove('error_border');
	document.getElementById('apellido').classList.remove('error_border');
	document.getElementById('email').classList.remove('error_border');
	document.getElementById('fecha_nac').classList.remove('error_border');
	document.getElementById('password').classList.remove('error_border');
	document.getElementById('password2').classList.remove('error_border');

	document.getElementById('nombre').classList.add('focus_azul');
	document.getElementById('apellido').classList.add('focus_azul');
	document.getElementById('email').classList.add('focus_azul');
	document.getElementById('fecha_nac').classList.add('focus_azul');
	document.getElementById('password').classList.add('focus_azul');
	document.getElementById('password2').classList.add('focus_azul');	
	
}

function validar_nombre() {

	var nombre = document.getElementById('nombre');
	limpiar_errores();
	if (!nombre.value){
		nombre.classList.remove('focus_azul');
		nombre.classList.add('error_border');
		document.getElementById('error_nombre').innerHTML="campo incompleto";
		nombre.focus();
		alert("Error: campo Nombre incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_apellido() {
	var apellido = document.getElementById('apellido');
	limpiar_errores();
	if (!apellido.value){
		apellido.classList.remove('focus_azul');
		apellido.classList.add('error_border');
		document.getElementById('error_apellido').innerHTML="campo incompleto";
		apellido.focus();
		alert("Error: campo apellido incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_email() {
	var email = document.getElementById('email');
	limpiar_errores();
	if (!email.value){
		email.classList.remove('focus_azul');
		email.classList.add('error_border');
		document.getElementById('error_email').innerHTML="campo incompleto";
		email.focus();
		alert("Error: campo email incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_FechaN() {
	var fecha_nac = document.getElementById('fecha_nac');
	limpiar_errores();
	if (!fecha_nac.value){
		fecha_nac.classList.remove('focus_azul');
		fecha_nac.classList.add('error_border');
		document.getElementById('error_fecha_nac').innerHTML="campo incompleto";
		fecha_nac.focus();
		alert("Error: campo fecha_nac incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
//----------------------------------------
function validar_claves() {
	//var exp_Blancos=/\s/;
	
	var password = document.getElementById('password');
	var password2 = document.getElementById('password2');
	
	limpiar_errores();
	if (!password.value){
		password.classList.remove('focus_azul');
		password.classList.add('error_border');
		document.getElementById('error_password').innerHTML="campo incompleto";
		password.focus();
		alert("Error: campo de la contraseña incompleto, por favor complete el campo.");
		return false;
	}
	if (password.value.length < 6 ) {
		password.classList.remove('focus_azul');
		password.classList.add('error_border');
		document.getElementById('error_password').innerHTML="la contraseña debe de ser mayor o igual a 6";
		password.focus();
		alert("Error: en la la contraseña.");
		return false;
	}
	if (!password2.value){
		password2.classList.remove('focus_azul');
		password2.classList.add('error_border');
		document.getElementById('error_password2').innerHTML="campo incompleto";
		password2.focus();
		alert("Error: campo Repetir contraseña incompleto, por favor complete el campo.");
		return false;
	}
	if(password.value!= password2.value){
		password2.classList.remove('focus_azul');
		password2.classList.add('error_border');
		document.getElementById('error_password2').innerHTML="Las contraseñas no coiciden";
		password2.focus();
		alert("Error: las contraseñas coiciden.");
		return false;
	}
	return true;
}
//----------------------------------------------
function validar(){
   if(validar_nombre() && validar_apellido() && validar_email() && validar_FechaN() && validar_claves()){
   	return true;
   }
   return false;
}

window.onload = function(){
  document.getElementById('f1_registro').onsubmit = validar;
}



