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
	$id_user = $_POST['id_user'];
	$estado = $_POST['estado'];
	$fecha = date('Y-m-d h:i:s');

	//comprobar que el usuario no esta dado de alta en el sistema
	$comprobar = "SELECT count(*) as total_usuarios FROM usuarios where id = '$id_user' order by Nombre asc";
	$comprobaras = mysql_query($comprobar, $khablasweb) or die(mysql_error());
	$row_comprobar = mysql_fetch_assoc($comprobaras);

	if($row_comprobar['total_usuarios'] != 0){
		try{
			$nuevo = "UPDATE usuarios set Nombre = '$nombre', Apellidos = '$apellidos', DNI = '$dni', 
			Email = '$email', Telefono = '$telefono', Id_tipo = '$tipo', Login = '$usuario', Pass = '$pass', 
				baja = '$estado', Fecha_modificacion = '$fecha' where id = '$id_user'";
			$nuevos = mysql_query($nuevo, $khablasweb) or die(mysql_error());
		}catch(Exception $e)
		{
			echo  "Error: No se ha podido Dar de Alta el Usuario, Intentelo más Tarde";
		}
		//una vez echo esto le damos los permisos apropiados

		//Eliminamos todos los permisos que tubiera
		$permisos_eliminar = "DELETE from permisos where Id_Usuario = '$id_user'";
		$permisos_eliminaras = mysql_query($permisos_eliminar, $khablasweb) or die(mysql_error());


		foreach ($_POST['permisos'] as $aux) 
      	{
      		try{
	      		$permiso = "INSERT INTO permisos (Id_Usuario, Id_Accion) 
	      			values ('".$id_user."','".$aux."')";
	      		$permisos = mysql_query($permiso, $khablasweb) or die(mysql_error());
	      	}catch(Exception $e)
			{
				$eliminar = "DELETE from usuarios where id = '".$row_id['Id']."'";
	      		$eliminaras = mysql_query($eliminar, $khablasweb) or die(mysql_error());
				echo  "Error: Se ha producido un error al asignarle los permisos.";
			}
      	}

		echo "El Usuario ha sido modificado Correctamente";
	} else {
		echo  "El usuario no existe en el sistema";
	}
?>

