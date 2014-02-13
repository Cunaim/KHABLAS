function validar()
{
	var caracteres = new Array(" ","%","'");
	var usuario = $("#txtuser").val();
	var pass = $("#txtpass").val();
	//para eviatar lios quitamos los espacios
	for (i=0; i<3;i++)
	{
		usuario = usuario.replace("/"caracteres[i]"/gi","");
		pass = pass.replace("/"caracteres[i]"/gi","");
	}

	//validaciones previas: comprobar que se ha introducido el usuario y la password
	if(pass.length != 0 || usuario.length != 0){
		$( "#dialog-message" ).dialog( "close" );
		$("#mensaje").html("Error: El usuario y/o clave no pueden estar vacios");
	}
	else if()
	//1º Activamos el aviso para que sea visible
	$( "#dialog-message" ).dialog({
		modal: true
	});
	//2º mandamos la información para validar el user/pass
	var parametros = {
        "usuario" : $("#txtuser").val(),
        "pass" : $("#txtpass").val()
        };
	$.ajax({
        url:"Validar.php",
        dataType : "json",//el tipo de datos
        data:parametros,
        type: "POST",
        success: function(opciones){
        	if(opciones == 1){ //todo correcto
        		$( "#dialog-message" ).dialog( "close" );
        		document.location.href="principal.php";
        	}
        	else
        	{
        		$("#mensaje").html("Error: El usuario y/o clave no son correcto, pulse escape para volver a introducirlos");
        	}
        }
      })
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
				}
		}
		
}