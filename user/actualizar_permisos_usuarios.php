<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	//1º obtenmos los datos que nos mandan desde consulta de usuarios
	$id_tipo = $_POST['id_tipo'];
	$id_permisos = $_POST['id_permisos'];

	//2º Borrar todos los  permisos que tenga el usuario
	try{
		$Borrar = "DELETE from tipo_seccion where Id_tipo = '$id_tipo'";
		$Borraras = mysql_query($Borrar, $khablasweb) or die(mysql_error());
	} catch(Exception $e){
		echo "Error: No se ha podido eliminar los permisos anteriores";
		return;
	}

	//3º Meto los nuevo permisos
	foreach ($id_permisos as $id) {
		try{
			$insertar = "INSERT INTO tipo_seccion (Id_tipo, Id_Seccion) values ('$id_tipo','$id')";
			$insertaras = mysql_query($insertar, $khablasweb) or die(mysql_error());
		} catch(Exception $e){
			echo "Error: No se ha podido asignar el permiso ".$id."al usuario";
			return;
		}
	}

	echo "La asignacion de Permisos se ha realizado Correctamente";



?>