<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	//1º obtenmos los datos que nos mandan desde consulta de usuarios
	$nombre = trim($_POST['nombre']); $nombre2 = $nombre;
	if($nombre == '' || $nombre = 'Cu4l0u13r4') { $nombre = '%'; $nombre2 = "Cu4l0u13r4"; }
	$apellidos = trim($_POST['apellidos']); $apellidos2 = $apellidos;
	if($apellidos == '' || $apellidos = 'Cu4l0u13r4') { $apellidos = '%'; $apellidos2 = "Cu4l0u13r4"; }
	$dni = trim($_POST['dni']); $dni2 = $dni;
	if($dni == '' || $dni = 'Cu4l0u13r4') { $dni = '%'; $dni2 = "Cu4l0u13r4"; }
	$email = trim($_POST['email']); $email2 = $email;
	if($email == '' || $email = 'Cu4l0u13r4') { $email = '%'; $email2 = "Cu4l0u13r4"; }
	$telefono = trim($_POST['telefono']); $telefono2 = $telefono;
	if($telefono == '' || $telefono = 'Cu4l0u13r4') { $telefono = '%'; $telefono2 = "Cu4l0u13r4"; }
	$tipo = trim($_POST['tipo']); $tipo2 = $tipo;
	if($tipo == '0' || $tipo = 'Cu4l0u13r4') { $tipo = '%'; $tipo2 = "0"; }

	//pasamos los datos a js para tenerlos y usarlos
	$datos = array($nombre2,$apellidos2,$dni2,$email2,$telefono2,$tipo2);
	$datos_js = implode("-", $datos);
	//con el implode paso el array a una cadena de string separada por - una vez echo esto lo paso luego a cadena otra vez

	//2º Consulto los datos que me piden
	$consulta = "SELECT usuarios.id as id_user, usuarios.*, tipo_usuario.Nombre as Tipo FROM usuarios 
	inner join tipo_usuario on tipo_usuario.Id = usuarios.Id_tipo
	where usuarios.Nombre like '$nombre' and usuarios.Apellidos like '$apellidos' and usuarios.DNI like '$dni' 
	and usuarios.Telefono like '$telefono' and usuarios.Id_tipo like '$tipo' and 
	usuarios.Email like '$email' order by usuarios.Nombre asc";
	$consultas = mysql_query($consulta, $khablasweb) or die(mysql_error());
	$row_consulta = mysql_fetch_assoc($consultas);
	$nconsulta = mysql_num_rows($consultas);
?>
<div class="col-sm-12 header-form"><h4>Usuarios Consultados </h4></div>
<div class="col-sm-4"></div>
<div class=" col-sm-12 col-form-background">
	<div class="table-responsive">

<?php if($nconsulta != 0) { ?>
		<table table class='header'>
			<tr>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>DNI</td>
				<td>Email</td>
				<td>Teléfono</td>
				<td>Tipo de Usuario</td>
				<?php if($_POST['tipo_consulta'] > 2 && $_POST['tipo_consulta'] < 5){ ?>
					<td>Accion</td>
				<?php } ?>
			</tr>
			<?php do{ ?>
				<tr>
				<td><?php echo $row_consulta['Nombre']; ?></td>
				<td><?php echo $row_consulta['Apellidos']; ?></td>
				<td><?php echo $row_consulta['DNI']; ?></td>
				<td><?php echo $row_consulta['Email']; ?></td>
				<td><?php echo $row_consulta['Telefono']; ?></td>
				<td><?php echo $row_consulta['Tipo']; ?></td>
				<?php if(trim($_POST['tipo_consulta']) == 3) { //modificar ?> 
					<td>
						<a onclick="modificar_usuario('<?php echo $row_consulta["id_user"]; ?>','<?php echo $datos_js; ?>');" >
							<i class="fa fa-pencil-square-o"></i>
						</a>
					</td>
				<?php } else if(trim($_POST['tipo_consulta']) == 4) { //eliminar ?> 
					<td>
						<a onclick="eliminar_usuario('<?php echo $row_consulta["id_user"]; ?>');" >
							<i class="fa fa-times"></i>
						</a>
					</td>
				<?php } ?>
				</tr>
			<?php }while($row_consulta = mysql_fetch_assoc($consultas)); ?>
		</table>
<?php } else { ?>
		<h3> No Existen Datos </h3>
<?php } ?>
	</div>
</div>