function mostrar() {
	var msj=document.getElementById('msj');
	msj.classList.add('habilitar');

}
function diario() {
	
	var dias=document.getElementById('dias');
	dias.innerHTML="¿Por cuantos dias?";
	mostrar();

}
function semanal() {
	var dias=document.getElementById('dias');
	dias.innerHTML="¿Por cuantos semanas?";
	mostrar();
}
function remover() {
	var msj=document.getElementById('msj');
	msj.classList.remove('habilitar');

}
function evento() {
	varios=document.getElementById('varios');
	if (varios.selectedIndex ==2) {
		mostrar();
		diario();

	}
	if (varios.selectedIndex ==3) {
		mostrar();
		semanal();

	}
	if (varios.selectedIndex ==1 || varios.selectedIndex==0) {
		remover();

	}
}

function validar_tipo() {
	//var tipo =document.getElementsByName('tipo');
	var cantidad =document.getElementById('cantidad');
	var varios= document.getElementById('varios');
	//alert(!cantidad.value);
	//alert(varios.selectedIndex);
	if (varios.selectedIndex == 0) {
		alert("Selecciones un tipo de viaje");
		return false;
	}
	if (varios.selectedIndex == 2) {
		if (!cantidad.value == true) {
			alert("Es necesario que indique la cantidad de dias");
			return false;
		}
		if (!cantidad.value == false) {
			return true;
		}
		
	}
	if (varios.selectedIndex == 3) {
		if (!cantidad.value == true) {
			alert("Es necesario que indique la cantidad de semanas");	
			return false;
		}
		if (!cantidad.value == false) {
			return true;
		}
		
	}
	
	return true;
	

}


function validar_form() {
	if (validar_tipo()) {
		return true;
	}
	return false;	
}


window.onload = function () {
	document.getElementById('form_viaje').onsubmit=validar_form;
	document.getElementById('varios').onclick=evento;


}


