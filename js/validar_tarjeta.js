function limpiar_errores() {

	document.getElementById('error_nro_tarjeta').innerHTML="";
	document.getElementById('error_clave').innerHTML="";
	document.getElementById('error_nombre').innerHTML="";
	document.getElementById('error_apellido').innerHTML="";
	document.getElementById('error_dni').innerHTML="";
	document.getElementById('msj_fecha').innerHTML="";


	document.getElementById('nro_tarjeta').classList.remove('error_border');
    document.getElementById('clave').classList.remove('error_border');
    document.getElementById('nombre').classList.remove('error_border');   
    document.getElementById('apellido').classList.remove('error_border');     
    document.getElementById('dni').classList.remove('error_border'); 
    document.getElementById('fecha').classList.remove('error_border');  


	document.getElementById('nro_tarjeta').classList.add('focus_azul');
	document.getElementById('clave').classList.add('focus_azul');
	document.getElementById('nombre').classList.add('focus_azul');	
	document.getElementById('apellido').classList.add('focus_azul');
	document.getElementById('dni').classList.add('focus_azul');
	document.getElementById('fecha').classList.add('focus_azul');
	
}

function validar_nro_tarjeta(){
	var numero = document.getElementById('nro_tarjeta');
    limpiar_errores();
	if (!numero.value){
		nro_tarjeta.classList.remove('focus_azul');
		nro_tarjeta.classList.add('error_border');
		document.getElementById('error_nro_tarjeta').innerHTML="campo incompleto";
		nro_tarjeta.focus();
		alert("Error: campo Nro de tarjeta incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_clave(){
	var clave = document.getElementById('clave');
    
	if (!clave.value){
		clave.classList.remove('focus_azul');
		clave.classList.add('error_clave');
		document.getElementById('error_clave').innerHTML="campo incompleto";
		clave.focus();
		alert("Error: campo clave incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_nombre(){
	var nombre = document.getElementById('nombre');
    
	if (!nombre.value){
		nombre.classList.remove('focus_azul');
		nombre.classList.add('error_nombre');
		document.getElementById('error_nombre').innerHTML="campo incompleto";
		nombre.focus();
		alert("Error: campo nombre incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_apellido(){
	var apellido = document.getElementById('apellido');
    
	if (!apellido.value){
		apellido.classList.remove('focus_azul');
		apellido.classList.add('error_apellido');
		document.getElementById('error_apellido').innerHTML="campo incompleto";
		apellido.focus();
		alert("Error: campo apellido incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_dni(){
	var dni = document.getElementById('dni');
    
	if (!dni.value){
		dni.classList.remove('focus_azul');
		dni.classList.add('error_dni');
		document.getElementById('error_dni').innerHTML="campo incompleto";
		dni.focus();
		alert("Error: campo dni incompleto, por favor complete el campo.");
		return false;
	}
	return true;
}
function validar_fecha() {
	var fecha =document.getElementById('fecha');
	var actual = new Date().toISOString().slice(0,10);		
	if (!fecha.value) {
		document.getElementById('msj_fecha').innerHTML="seleccione una fecha";
		fecha.focus();
		fecha.classList.remove('focus_azul');
		fecha.classList.add('error_border');
		return false;
	}
	if (fecha.value <=actual.toString()) {
		fecha.classList.remove('focus_azul');
		fecha.classList.add('error_border');
		document.getElementById('msj_fecha').innerHTML="Tarjeta vencida ";
		
		
		fecha.focus();
		return false;

	}
	return true;
}

function validar(){
	limpiar_errores();
	if (validar_nro_tarjeta() && validar_clave() && validar_fecha() && validar_nombre() && validar_apellido() && validar_dni()){
		return true;
	}
	return false;

}
window.onload = function(){
	document.getElementById('validar_tarjeta').onsubmit = validar;
}