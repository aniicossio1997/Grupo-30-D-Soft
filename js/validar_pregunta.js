function validar_pregunta()
{
	var respuesta = document.getElementById('resp');
	if (!respuesta.value) 
	{
		resp.focus();
		alert("Por favor, ingrese una respuesta");
		return false;
	}
	return true;
}

function validar()
{
	if (validar_pregunta()){
		return true;
	}
	return false;
}

window.onload = function()
{
	document.getElementById('form1').onsubmit = validar;
}

