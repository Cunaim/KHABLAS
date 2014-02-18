<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$id_tipo = $_POST['id_tipo'];

	$tipo_seccion = "SELECT * from tipo_seccion where Id_Tipo = '$id_tipo'";
	$tipo_secciones = mysql_query($tipo_seccion, $khablasweb) or die(mysql_error());
	$row_tipo_seccion = mysql_fetch_assoc($tipo_secciones);
	$ntipo_seccion = mysql_num_rows($tipo_secciones);

	$seccion = "SELECT * FROM seccion order by id asc";
	$secciones = mysql_query($seccion, $khablasweb) or die(mysql_error());
	$row_secciones = mysql_fetch_assoc($secciones);

	$texto = "";
	do{
		$id = $row_secciones['Id'];
		$nombre = $row_secciones['Nombre'];

		$texto .= "<option value='$id'";
		if($ntipo_seccion != 0)
		{
			mysql_data_seek($tipo_secciones, 0); 
			do{
				if($row_secciones['Id'] == $row_tipo_seccion['Id_Seccion'])
					$texto .= "selected ";
			}while($row_tipo_seccion = mysql_fetch_assoc($tipo_secciones));
		}
		$texto .= ">$nombre</option>";
	}while($row_secciones = mysql_fetch_assoc($secciones));
	
	echo $texto;
	
?>