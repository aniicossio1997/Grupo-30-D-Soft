function limpiar_errores(){
	document.getElementById('error_nombre').innerHTML=" ";
	document.getElementById('error_apellido').innerHTML=" ";
	document.getElementById('error_fecha').innerHTML=" ";
	document.getElementById('error_password').innerHTML="";
	document.getElementById('error_password2').innerHTML="";

	
	
	
}
function validar_nombre(){
	var nom = document.getElementById('nombre');
	limpiar_errores();
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
	limpiar_errores();
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
	limpiar_errores();
	if (!fecha.value){
		document.getElementById('error_fecha').innerHTML="Campo incompleto";
		fecha.focus();
		alert("Error: campo Fecha de nacimiento incompleto.");
		return false;
	}
	return true;
}

//----------------------------

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

function validar(){	
	 if (validar_nombre() && validar_apellido() && validar_nacimiento() && validar_claves()){
	    	return true;
	 }
	 return false;
	
}
window.onload = function(){
	document.getElementById('form').onsubmit = validar;
}