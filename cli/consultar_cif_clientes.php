<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo_user = $_POST['tipo_cif'];

	$cif = "SELECT Id,  nombre from clientes where Tipo_cliente = '$tipo_user'";
	$cifs = mysql_query($cif, $khablasweb) or die(mysql_error());
	$row_cif = mysql_fetch_assoc($cifs);
	$ncif = mysql_num_rows($cifs);

	$texto = "<option value='0'>--Seleccione un CIF--</option>";
	if($ncif > 0)
	{
		do{
			$texto += "<option value='".$row_cif['Id']."'>".$row_cif['Nombre']."</option>";
		}while($row_cif = mysql_fetch_assoc($cifs));
	}
	echo $texto;
	
?>