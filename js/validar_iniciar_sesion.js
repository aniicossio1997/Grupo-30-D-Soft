function validar_mail(){
  var mail = document.getElementById('email');
  document.getElementById('error_email').innerHTML=" ";
    if(!mail.value) {
      document.getElementById('error_email').innerHTML="campo incompleto";
      mail.focus();
      alert("Error!, el campo contraseña esta vacio.");
      return false;
    }
       return true;

}

function validar_password(){
	var pasw = document.getElementById('password');
  document.getElementById('error_password').innerHTML=" ";
   if(!pasw.value) {
    document.getElementById('error_password').innerHTML="campo incompleto";
    pasw.focus();
   	alert("Error!, el campo contraseña esta vacio.");
   	return false;
   }
   return true;
}

function validar(){
  if(validar_mail() && validar_password() ){
    return true
  }
  return false;
}

window.onload = function(){

	document.getElementById('form').onsubmit = validar;
}
