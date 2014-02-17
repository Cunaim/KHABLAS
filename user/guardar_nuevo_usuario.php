<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	//datos
	$nombre= $_POST['nombre'];
	$apellidos= $_POST['apellidos'];
	$dni= $_POST['dni'];
	$email= $_POST['email'];
	$telefono= $_POST['telefono'];
	$tipo= $_POST['tipo'];
	$usuario= $_POST['usuario'];
	$pass= $_POST['pass'];
	$fecha = date('Y-m-d h:i:s');

	//comprobar que el usuario no esta dado de alta en el sistema
	$comprobar = "SELECT count(*) as total_usuarios FROM usuarios where DNI = '$dni' or Email like '$email' order by Nombre asc";
	$comprobaras = mysql_query($comprobar, $khablasweb) or die(mysql_error());
	$row_comprobar = mysql_fetch_assoc($comprobaras);

	if($row_comprobar['total_usuarios'] == 0){
		try{
			$nuevo = "INSERT INTO usuarios (Nombre, Apellidos, DNI, Email, Telefono, Id_tipo, Login, Pass, baja, Fecha_alta, 
				Fecha_modificacion) values ('$nombre','$apellidos', '$dni','$email','$telefono','$tipo','$usuario',
				'$pass','0','$fecha','$fecha')";
			$nuevos = mysql_query($nuevo, $khablasweb) or die(mysql_error());
		}catch(Exception $e)
		{
			echo  "Error: No se ha podido Dar de Alta el Usuario, Intentelo más Tarde";
		}
		//una vez echo esto le damos los permisos apropiados

		//primero obtenemos la id del tio que acabos de meter
		$id = "SELECT Id FROM usuarios where DNI = '$dni' and Email like '$email' and Nombre = '$nombre'
		and Apellidos = '$apellidos' order by Nombre asc";
		$ids = mysql_query($id, $khablasweb) or die(mysql_error());
		$row_id = mysql_fetch_assoc($ids);


		foreach ($_POST['permisos'] as $aux) 
      	{
      		try{
	      		$permiso = "INSERT INTO permisos (Id_Usuario, Id_Accion) 
	      			values ('".$row_id['Id']."','".$aux."')";
	      		$permisos = mysql_query($permiso, $khablasweb) or die(mysql_error());
	      	}catch(Exception $e)
			{
				$eliminar = "DELETE from usuarios where id = '".$row_id['Id']."'";
	      		$eliminaras = mysql_query($eliminar, $khablasweb) or die(mysql_error());
				echo  "Error: Se ha producido un error al asignarle los permisos.";
			}
      	}

		echo 0;
	} else {
		echo  "El usuario esta ya dado de alta en el sistema";
	}
?>

