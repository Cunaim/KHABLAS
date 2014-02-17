<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	//1º obtenmos los datos que nos mandan desde consulta de usuarios
	$nombre = $_POST['nombre'];
	if($nombre == '') $nombre = '%';
	$apellidos = $_POST['apellidos'];
	if($apellidos == '') $apellidos = '%';
	$dni = $_POST['dni'];
	if($dni == '') $dni = '%';
	$email = $_POST['email'];
	if($email == '') $email = '%';
	$telefono = $_POST['telefono'];
	if($telefono == '') $telefono = '%';
	$tipo = $_POST['tipo'];
	if($tipo == '0') $tipo = '%';

	//2º Consulto los datos que me piden
	$consulta = "SELECT usuarios.*, tipo_usuario.Nombre as Tipo FROM usuarios 
	inner join tipo_usuario on tipo_usuario.Id = usuarios.Id_tipo
	where usuarios.Nombre like '$nombre' and usuarios.Apellidos like '$apellidos' and usuarios.DNI like '$dni' 
	and usuarios.Telefono like '$telefono' and usuarios.Id_tipo like '$tipo' and 
	usuarios.Email like '$email' order by usuarios.Nombre asc";
	$consultas = mysql_query($consulta, $khablasweb) or die(mysql_error());
	$row_consulta = mysql_fetch_assoc($consultas);
	$nconsulta = mysql_num_rows($consultas);

$texto = "<h2> Consulta de Usuario </h2>";
if($nconsulta != 0) {
	$texto .= "<table>
		<tr>
			<td> <label>Nombre</label> </td>
			<td> <label>Apellidos</label> </td>
			<td> <label>DNI</label> </td>
			<td> <label>Email</label> </td>
			<td> <label>Teléfono</label> </td>
			<td> <label>Tipo de Usuario</label> </td>";
			if($_POST['tipo_consulta'] != 1)
				$texto .= "<td> <label>Accion</label> </td>";
		$texto .= "</tr>";
		do { 
			$texto .= "<tr>";
			$texto .= "	<td>" . $row_consulta['Nombre'] ."</td>";
			$texto .= "	<td>" . $row_consulta['Apellidos']."</td>";
			$texto .= "	<td>" . $row_consulta['DNI'] ."</td>";
			$texto .= "	<td>" . $row_consulta['Email'] ."</td>";
			$texto .= "	<td>" . $row_consulta['Telefono'] ."</td>";
			$texto .= "	<td>" . $row_consulta['Tipo'] ."</td>";
			if($_POST['tipo_consulta'] == 2)
				$texto .= '<td><a onclick="modificar_usuario($row_consulta["id"]);">
								<i class="fa fa-pencil-square-o"></i></a></td>';
			else if($_POST['tipo_consulta'] == 3)
				$texto .= '<td><a onclick="eliminar_usuario($row_consulta["id"]);">
								<i class="fa fa-times"></i></a></td>';
			$texto .= "</tr>";
		}while($row_consulta = mysql_fetch_assoc($consultas));
	$texto .= "</table>";
} else {
	$texto .= "<h3> No Existen Datos </h3>";
}

echo $texto;
