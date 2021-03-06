function consulta_cif_clientes()
{
	var parametros = {
        "tipo_cif" : $("#txttipo_cliente").val()
	}
	$.ajax({
        url:"consultar_cif_clientes.php",
        dataType : "html",//el tipo de datos
        data:parametros,
        type: "POST",
        success: function(opciones){
        	$("#txtCIF_user").html(opciones);
        }
    })
}

function cambio_label(label, texto)
{
	$(label).html = texto;
}

function seleccionar_cliente()
{
	var tipo = $("#txttipo_cliente").val();
	switch(tipo){
		case "1":
			cambio_label("lbl_cambio", "Nombre Comercial");
			$("#div_cif_asociado").css("visibility", "hidden");
			break;
		case "2":
			cambio_label("lbl_cambio", "Matricula");
			$("#div_cif_asociado").css("visibility", "visible");
			consulta_cif_clientes();
			break;
		default:
			cambio_label("lbl_cambio", " ");
			$("#div_cif_asociado").css("visibility", "hidden");
			break;
	}
}

function Crear_nuevo_cliente()
{
	//para eviatar lios quitamos tonterias
	var formulario = document.getElementById("form1");
	var tipo_cliente = eliminar_caracteres_no_validos($("txttipo_cliente").val());
	var cif_asociado = eliminar_caracteres_no_validos($("txtCIF_user").val());
	var matricula = eliminar_caracteres_no_validos($("#txtnombre").val());
	var cif = eliminar_caracteres_no_validos($("#txtCIF").val());
	var email = eliminar_caracteres_no_validos($("#txtemail").val());
	var telefono = eliminar_caracteres_no_validos($("#txttelefono").val());
	var direccion = eliminar_caracteres_no_validos($("#txtdireccion").val());
	var Localidad = eliminar_caracteres_no_validos($("#txtlocalidad").val());
	var CPostal = eliminar_caracteres_no_validos($("#txtCPostal").val());
	var pass = eliminar_caracteres_no_validos($("#txtpass").val());
	var correcto = 1;

	//1º Activamos el aviso para que sea visible
	$( "#dialog-message" ).dialog( "open" );
	
	//comprobamos que todos los datos son correctos
	for(i=0; i < formulario.elements.length; i++)
	{
		if(formulario.elements[i].value.length == 0 && formulario.elements[i].name != "txtpermisos")
		{
			$("#mensaje").html("Error: debe completar todos los datos del formulario");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if (formulario.elements[i].name == "txttipo" && formulario.elements[i].value == 0)
		{
			$("#mensaje").html("Error: debe completar todos los datos del formulario");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtdni" && formulario.elements[i].value.length != 9)
		{
			$("#mensaje").html("Error: El DNI introducido no es válido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txttelefono" && formulario.elements[i].value.length != 9)
		{
			$("#mensaje").html("Error: El telefono introducido no es valido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtemail" && !validateEmail(formulario.elements[i].value))
		{
			$("#mensaje").html("Error: El Email introducido no es valido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtpermisos" && document.elements[i].selectedIndex == -1)
		{
			$("#mensaje").html("Error: Debe Introducir algun permiso al cliente");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
	}

	if(correcto == 1)
	{
		//2º mandamos la información para validar el user/pass
		var parametros = {
	        "nombre" : $("#txtnombre").val(),
			"apellidos" : $("#txtapellido").val(),
			"dni" : $("#txtdni").val(),
			"email" : $("#txtemail").val(),
			"telefono" : $("#txttelefono").val(),
			"tipo" : $("#txttipo").val(),
			"cliente" : $("#txtuser").val(),
			"pass" : $("#txtpass").val(),
			"permisos" : $("#txtpermisos").val()
		}
		$.ajax({
	        url:"guardar_nuevo_cliente.php",
	        dataType : "json",//el tipo de datos
	        data:parametros,
	        type: "POST",
	        success: function(opciones){
	        	if(opciones == 0) { //todo correcto
	        		for(i=0; i< formulario.elements.length; i++) {
						if(formulario.elements[i].name == "txttipo")
							formulario.elements[i].value = 0;
						else
							if(formulario.elements[i].name != "btncrear")
								formulario.elements[i].value = "";
					}
	        		$("#mensaje").html("cliente Dado de alta Correctamente");
	        	}
	        	else {
	        		$("#mensaje").html(opciones);
	        	}
	        }
	    })
	}
}

function consultar_cliente(){
	//para eviatar lios quitamos tonterias
	var formulario = document.getElementById("form1")
	var nombre = eliminar_caracteres_no_validos($("#txtnombre").val());
	var apellidos = eliminar_caracteres_no_validos($("#txtapellido").val());
	var dni = eliminar_caracteres_no_validos($("#txtdni").val());
	var email = eliminar_caracteres_no_validos($("#txtemail").val());
	var telefono = eliminar_caracteres_no_validos($("#txttelefono").val());
	var tipo = eliminar_caracteres_no_validos($("#txttipo").val());
	var correcto = 0;
	//1º Activamos el aviso para que sea visible
	$( "#dialog-message" ).dialog( "open" );

	//comprobamos que todos los datos son correctos
	for(i=0; i < formulario.elements.length; i++)
	{
		if(formulario.elements[i].value.length != 0 || 
			(formulario.elements[i].name == "txttipo" && formulario.elements[i].value == 0))
			correcto = 1;
	}

	if(correcto == 0)
	{
		$("#mensaje").html("Error: debe completar al menos un campo");
	}
	else
	{
		//2º mandamos la información para validar el user/pass
		var parametros = {
	        "nombre" : $("#txtnombre").val(),
			"apellidos" : $("#txtapellido").val(),
			"dni" : $("#txtdni").val(),
			"email" : $("#txtemail").val(),
			"telefono" : $("#txttelefono").val(),
			"tipo" : $("#txttipo").val(),
			"tipo_consulta" : $("#txttipo_consulta").val() 
			//este parametro es para saber que queremos hacer con la consulta tipo_consulta = 1 -> solo consulta,
			//tipo_consulta = 2 -> Se desea modificar el resultado, tipo_consulta = 3 -> se desea eleminar el resultado
		};
		$.ajax({
	        url:"resultado_consulta_clientes.php",
	        dataType : "html",//el tipo de datos
	        data: parametros,
	        type: "POST",
	        success: function(opciones){
	        	//cierro la ventana primero
	        	$( "#respuesta" ).html(opciones);
	        	$( "#dialog-message" ).dialog( "close" );
	        },
	        error: function (req, status, err){
	        	$("#mensaje").html(req+"->"+status+"->"+err);
	        	//$("#mensaje").html("Error: No se puede generar la respuesta intentelo más tarde");
	        }
	    });
	    
	}
}

function eliminar_cliente(id)
{
	$( "#dialog-message" ).dialog( "open" );
	var parametros = { "id_user" : id };
	$.ajax({
	        url:"dar_baja_cliente.php",
	        dataType : "html",//el tipo de datos
	        data: parametros,
	        type: "POST",
	        success: function(opciones){
	        	//cierro la ventana primero
	        	$( "#mensaje" ).html(opciones);
	        },
	        error: function (req, status, err){
	        	$("#mensaje").html(req+"->"+status+"->"+err);
	        	//$("#mensaje").html("Error: No se puede generar la respuesta intentelo más tarde");
	        }
	    });
}

function modificar_cliente(id)
{
	$( "#dialog-message" ).dialog( "open" );
	var parametros = { "id_user" : id };
	$.ajax({
	        url:"modificar_cliente.php",
	        dataType : "html",//el tipo de datos
	        data: parametros,
	        type: "POST",
	        success: function(opciones){
	        	//cierro la ventana primero
	        	$( "#formulario" ).html(opciones);
	        	$( "#dialog-message" ).dialog( "close" );
	        },
	        error: function (req, status, err){
	        	$("#mensaje").html(req+"->"+status+"->"+err);
	        	//$("#mensaje").html("Error: No se puede generar la respuesta intentelo más tarde");
	        }
	    });
}

function Actualizar_cliente(id)
{
	//para eviatar lios quitamos tonterias
	var formulario = document.getElementById("form1")
	var nombre = eliminar_caracteres_no_validos($("#txtnombre").val());
	var apellidos = eliminar_caracteres_no_validos($("#txtapellido").val());
	var dni = eliminar_caracteres_no_validos($("#txtdni").val());
	var email = eliminar_caracteres_no_validos($("#txtemail").val());
	var telefono = eliminar_caracteres_no_validos($("#txttelefono").val());
	var tipo = eliminar_caracteres_no_validos($("#txttipo").val());
	var cliente = eliminar_caracteres_no_validos($("#txtuser").val());
	var pass = eliminar_caracteres_no_validos($("#txtpass").val());
	var correcto = 1;

	//1º Activamos el aviso para que sea visible
	$( "#dialog-message" ).dialog( "open" );
	
	//comprobamos que todos los datos son correctos
	for(i=0; i < formulario.elements.length; i++)
	{
		if(formulario.elements[i].value.length == 0 && formulario.elements[i].name != "txtpermisos")
		{
			$("#mensaje").html("Error: debe completar todos los datos del formulario");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if (formulario.elements[i].name == "txttipo" && formulario.elements[i].value == 0)
		{
			$("#mensaje").html("Error: debe completar todos los datos del formulario");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtdni" && formulario.elements[i].value.length != 9)
		{
			$("#mensaje").html("Error: El DNI introducido no es válido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txttelefono" && formulario.elements[i].value.length != 9)
		{
			$("#mensaje").html("Error: El telefono introducido no es valido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtemail" && !validateEmail(formulario.elements[i].value))
		{
			$("#mensaje").html("Error: El Email introducido no es valido");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
		else if(formulario.elements[i].name == "txtpermisos" && document.elements[i].selectedIndex == -1)
		{
			$("#mensaje").html("Error: Debe Introducir algun permiso al cliente");
			formulario.elements[i].focus();
			correcto = 0;
			break;
		}
	}

	if(correcto == 1)
	{
		//2º mandamos la información para validar el user/pass
		var parametros = {
	        "nombre" : $("#txtnombre").val(),
			"apellidos" : $("#txtapellido").val(),
			"dni" : $("#txtdni").val(),
			"email" : $("#txtemail").val(),
			"telefono" : $("#txttelefono").val(),
			"tipo" : $("#txttipo").val(),
			"cliente" : $("#txtuser").val(),
			"pass" : $("#txtpass").val(),
			"permisos" : $("#txtpermisos").val(),
			"id_user" : $("#txtiduser").val(),
			"estado" : $("#txtestado").val()
		}
		$.ajax({
	        url:"actualizar_cliente.php",
	        dataType : "html",//el tipo de datos que espero recibir
	        data:parametros,
	        type: "POST",
	        success: function(opciones){
	        		$("#mensaje").html(opciones);
	        }
	    })
	}
}