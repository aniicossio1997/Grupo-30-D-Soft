function limpiar() {
  document.getElementById('error_email').innerHTML="";
  document.getElementById('error_password').innerHTML="";

  document.getElementById('email').classList.remove('error_border');
  document.getElementById('password').classList.remove('error_border');

  document.getElementById('email').classList.add('focus_azul');
  document.getElementById('password').classList.add('focus_azul');
}

function validar_email(){
  var email = document.getElementById('email');
  limpiar();

  if(!email.value) {
      email.classList.remove('focus_azul');
      email.classList.add('error_border');
    
      document.getElementById('error_email').innerHTML="campo incompleto";
      email.focus();
      alert("Error:, el campo contraseña esta vacio.");
      return false;
  }
  return true;

}

function validar_password(){
	var pasw = document.getElementById('password');
  limpiar();
 
  if(!pasw.value) {
    pasw.classList.remove('focus_azul');
    pasw.classList.add('error_border');
    document.getElementById('error_password').innerHTML="campo incompleto";
    pasw.focus();
   	alert("Error:, el campo contraseña esta vacio.");
   	return false;
   }
   return true;
}

function validar(){
  if(validar_email() && validar_password()){
    return true
  }
  return false;
}

window.onload = function(){

	document.getElementById('form_sesion').onsubmit = validar;
}
