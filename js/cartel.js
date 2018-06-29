function ocultar_cartel() {
var cartel=document.getElementById('cartel');
cartel.classList.add('ocultar');
}

window.onload = function(){
	document.getElementById('cerrar').onclick = ocultar_cartel;

}