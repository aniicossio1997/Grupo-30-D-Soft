function validar_img() {
  var file_imagen = document.getElementById('imagen').files;
  var label_img =document.getElementById('img');

  if (file_imagen.length == 0) {
    alert("Campo incompleto, seleccione una imagen");
    return false;
  }else if (file_imagen.length > 1) {
    alert("Solo esta permitodo subir una imagen para la foto de perfil");
    return false;
  }else if (file_imagen[0].type != "image/png" && file_imagen[0].type!= "image/jpg" && file_imagen[0].type!= "image/jpeg" && file_imagen[0].type!= "image/gif" && file_imagen[0].type!="image/bmp" && file_imagen[0].type!="image/tif" ) { 
      alert(" El archivo no es una imagen, formatos solo se admiten imagenes");
      return false;
    } else if (file_imagen[0].size > 1024*1024*3) {
     
      alert("El tamaño de la imagen se exedio del limite, como maximo debe ser de 1MB");
     
      return false;
  }
  return true;
}
function validar_form() {
  if (validar_img()) {
    return true;
  }
  return false
}
function visualizar() {
	// body...
	var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('img_previa');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}
window.onload = function() {
	//document.getElementById('file_imagen').onchange= btn_file;
	
    document.getElementById('imagen').onchange = visualizar;
    document.getElementById('form_img').onsubmit = validar_form; 

	}