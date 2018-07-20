function revoveAll_Error() {
	document.getElementById('msj_vehi').innerHTML="";
	document.getElementById('msj_fecha').innerHTML="";
	document.getElementById('msj_hora').innerHTML="";
	document.getElementById('msj_origen').innerHTML="";
	document.getElementById('msj_destino').innerHTML="";
	document.getElementById('msj_costo').innerHTML=" ";
	document.getElementById('msj_duracion').innerHTML=" ";

	
	
	
}




function validar_vehiculo() {
	var vehiculo=document.getElementById('vehiculo');		
	if (vehiculo.selectedIndex==0) {
		document.getElementById('msj_vehi').innerHTML="seleccione un vehiculo";
		vehiculo.focus();
		return false;
	}return true;
}

function validar_fecha() {
	var fecha =document.getElementById('fecha');
	var actual = new Date().toISOString().slice(0,10);		
	if (!fecha.value) {
		document.getElementById('msj_fecha').innerHTML="seleccione una fecha";
		fecha.focus();
		alert("Error: campo fecha incompleto, por favor complete el campo.");
		
		return false;
	}
	if (fecha.value <=actual.toString()) {
		document.getElementById('msj_fecha').innerHTML="Recuerde que para crear un viaje la fecha debe ser posterior a la actual ";
		alert("Error: En la fecha");
		
		fecha.focus();
		return false;

	}
	return true;
}
function validar_hora() {
	var hora =document.getElementById('hora');	
	if (!hora.value) {
		document.getElementById('msj_hora').innerHTML="Campo incompleto, indique una hora";
		hora.focus();
		alert("Error: campo hora incompleto, por favor complete el campo.");
		
		return false;
	}return true;
}
function validar_origen() {
	var origen=document.getElementById('origen');	
	if (!origen.value) {
		document.getElementById('msj_origen').innerHTML="Campo incompleto, indique un origen";
		origen.focus();
		alert("Error:  campo origen incompleto, por favor complete el campo.");
		
		return false;
	}return true;
}
//----------------------------
function validar_destino() {
	var destino=document.getElementById('destino');	
	if (!destino.value) {
		document.getElementById('msj_destino').innerHTML="Campo incompleto, indique un destino";
		destino.focus();
		alert("Error: campo destino incompleto, por favor complete el campo.");
		
		return false;
	}return true;
}

function validar_costo() {
	var costo=document.getElementById('costo');
	if (!costo.value) {
		document.getElementById('msj_costo').innerHTML="Campo incompleto, indique un costo";
		costo.focus();
		alert("Error: campo costo incompleto, por favor complete el campo.");
		
		return false;
	}if (costo.value<0) {
		document.getElementById('msj_costo').innerHTML="Error el costo no puede ser negativo";
		costo.focus();
		alert("Error: campo costo.");
		return false;
	}
		
	return true;
}
function validar_duracion() {
	var duracion= document.getElementById('duracion');
	var minutos= document.getElementById('minutos');
	//alert(minutos.selectedIndex );
	//alert(((minutos.selectedIndex == 0 || minutos.selectedIndex == 60 ) && (!duracion.value || duracion.value== 0) || (minutos.selectedIndex==1 && duracion.value==0)));
	//return false;
	if ( (minutos.selectedIndex == 0 || minutos.selectedIndex == 60 ) && (!duracion.value || duracion.value== 0) ){
		document.getElementById('msj_duracion').innerHTML="complete al menos un campo";
		return false;
	}
		
	return true;
}



function validar_form() {
	revoveAll_Error();
	if (validar_vehiculo() &&validar_fecha()&& validar_hora() && validar_origen() && validar_destino() && validar_costo()&& validar_duracion()) {
		
		return true;
	}
	return false;	
}


function ocultar() {
	
	var car_error=document.getElementById('car_error');
	car_error.classList.add('ocultar');
}

window.onload = function () {

	document.getElementById('form_viaje').onsubmit=validar_form;
	
	document.getElementById('ok').onclick=ocultar;

	
	


}


