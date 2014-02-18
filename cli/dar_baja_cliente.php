<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	//datos
	$id = $_POST['id_user'];
	$fecha = date('Y-m-d h:i:s');

	//comprobar que el usuario no esta dado de alta en el sistema
	try{
		$dar_baja = "UPDATE usuarios set baja = '1', Fecha_modificacion = '$fecha' where id = '$id'";
		$dar_bajas = mysql_query($dar_baja, $khablasweb) or die(mysql_error());
	}catch(Exception $e)
	{
		echo  "Error: No se ha podido Dar de Baja el Usuario, Intentelo más Tarde";
	}

	echo "Usuario Dado de Baja Correctamente";	
?>

