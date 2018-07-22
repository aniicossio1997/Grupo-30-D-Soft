function limpiar() {
  document.getElementById('error_email').innerHTML="";

  document.getElementById('email').classList.remove('error_border');
  
  document.getElementById('email').classList.add('focus_azul');
}
function validar_email() {
	var email=document.getElementById('email');
	if (!email.value) {
		email.classList.remove('focus_azul');
      email.classList.add('error_border');
		email.focus();
		return false;
	}
	return true;
}


window.onload = function(){
	document.getElementById('form_rec').onsubmit = validar_email;
}