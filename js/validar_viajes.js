function revoveAll_Error() {
	document.getElementById('msj_vehi').innerHTML="";
	document.getElementById('msj_tipo').innerHTML="";
	document.getElementById('msj_error_sem').innerHTML="";
	document.getElementById('msj_tipo').innerHTML="";
	document.getElementById('msj_fecha').innerHTML="";
	document.getElementById('msj_hora').innerHTML="";
	document.getElementById('msj_origen').innerHTML="";
	document.getElementById('msj_destino').innerHTML="";
	document.getElementById('msj_costo').innerHTML=" ";
	document.getElementById('msj_duracion').innerHTML=" ";
	
}
function mostrarDiario() {
	
	var msj=document.getElementById('diario');
	msj.classList.add('habilitar');
}
function mostrarSemanal() {
	var msj=document.getElementById('msj_semanal');
	msj.classList.add('habilitar');
}
function mostrarOcacional() {

	var msj=document.getElementById('caja_oc');
	msj.classList.add('habilitar');
		
}
function removerOcacional(argument) {
	var msj=document.getElementById('caja_oc');
	msj.classList.remove('habilitar');

}
function removerDiario() {
	var msj=document.getElementById('diario');
	msj.classList.remove('habilitar');

}
function removerSemanal() {
	var msj=document.getElementById('msj_semanal');
	msj.classList.remove('habilitar');

}
function evento() {
	tipo=document.getElementById('tipo');
	if (tipo.selectedIndex ==2) {
		removerOcacional();
		removerSemanal();
		mostrarDiario();
	}
	if (tipo.selectedIndex ==3) {
		removerOcacional();
		removerDiario();
		mostrarSemanal();
	}
	if (tipo.selectedIndex==1 ) {
		removerDiario();
		removerSemanal();
		mostrarOcacional();
	}
	if (tipo.selectedIndex==0) {
		removerDiario();
		removerSemanal();
		removerOcacional();
	}

}

function validar_tipo() {
	//var tipo =document.getElementsByName('tipo');
	var tipo= document.getElementById('tipo');
	//alert(!cantidad.value);
	//alert(tipo.selectedIndex);
		
	if (tipo.selectedIndex == 0) {
		document.getElementById('msj_tipo').innerHTML="Selecciones un tipo de viaje";
		tipo.focus();
		return false;
	}
	if (tipo.selectedIndex==1) {
		if (validar_fecha()) {
			return true;
		}
		return false;
	}
	if (tipo.selectedIndex == 2) {
			return true;
	}
	if (tipo.selectedIndex == 3) {
		semanal=document.getElementById('semanal');	
		if (semanal.selectedIndex == 0) {
			document.getElementById('msj_error_sem').innerHTML="Indique un dia de la semana";
			semanal.focus();
			return false;
		}
		if (semanal.value > 0) {
			return true;
		}
		
	}
	
	return true;
	

}
function validar_vehiculo() {
	var vehiculo=document.getElementById('vehiculo');
		
	if (vehiculo.selectedIndex==0) {
		document.getElementById('msj_vehi').innerHTML="seleccione un vehiculo/Debe tener un vehiculo agregado";
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
		return false;
	}
	//alert(fecha.value);
	//alert("si la fecha que eleji es menor o igual a la actual");
	//alert(fecha <= actual.toString());
	//alert(actual.toString()>=fecha.value);

	if (actual.toString()>=fecha.value) {
		document.getElementById('msj_fecha').innerHTML="Recuerde que para crear un viaje la fecha debe ser posterior a la actual ";
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
		return false;
	}return true;
}
function validar_origen() {
	var origen=document.getElementById('origen');	
	if (!origen.value) {
		document.getElementById('msj_origen').innerHTML="Campo incompleto, indique un origen";
		origen.focus();
		return false;
	}return true;
}
//----------------------------
function validar_destino() {
	var destino=document.getElementById('destino');	
	if (!destino.value) {
		document.getElementById('msj_destino').innerHTML="Campo incompleto, indique un destino";
		destino.focus();
		return false;
	}return true;
}

function validar_costo() {
	var costo=document.getElementById('costo');
	if (!costo.value) {
		document.getElementById('msj_costo').innerHTML="Campo incompleto, indique un costo";
		costo.focus();
		return false;
	}if (costo.value<0) {
		document.getElementById('msj_costo').innerHTML="Error el costo no puede ser negativo";
		costo.focus();
		return false;
	}
		
	return true;
}
function validar_duracion() {
	var duracion= document.getElementById('duracion');
	if (!duracion.value) {
		document.getElementById('msj_duracion').innerHTML="Campo incompleto, indique la duracion del viaje";
		costo.focus();
		return false;
	}
		
	return true;
}
function validar_copilotos() {
	var copilotos= document.getElementById('copilotos');
	if (!copilotos.value) {
		document.getElementById('msj_eror_cop').innerHTML="Campo incompleto, indique la cantidad de acompañantes";
		copilotos.focus();
		alert("ERROR: Campo incompleto");
		return false;
	}
	if (!/^([1-9])*$/.test(numero)){
		document.getElementById('msj_eror_cop').innerHTML="El numero de acompañantes debe ser mayor o igual a 1";
		copilotos.focus();
		alert("ERROR: en la cantidad");
		return false;
	}
	return true;

}



function validar_form() {
	revoveAll_Error();
	if (validar_vehiculo() && validar_copilotos()&& validar_tipo() && validar_hora() && validar_origen()) {
		
		return true;
	}
	alert("Error: verifique que todos los campos esten completos");
	return false;	
}
function mostrar_msj() {

	document.getElementById('msj_cop').classList.add('habilitar');
	
}
function eliminar_msj() {
	document.getElementById('msj_cop').classList.remove('habilitar');
}


window.onload = function () {

	document.getElementById('form_viaje').onsubmit=validar_form;
	document.getElementById('tipo').onclick=evento;
	document.getElementById('copilotos').onfocus=mostrar_msj;
	document.getElementById('copilotos').onblur= eliminar_msj;
	//document.getElementById('copilotos').onkeydown=eliminar_msj;
	


}


