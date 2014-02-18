<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$usuario = "SELECT usuarios.*, usuarios.baja as dado_baja, permisos.Id_Accion from usuarios
	inner join permisos on permisos.Id_Usuario = usuarios.Id
	where usuarios.id = '".$_POST['id_user']."'";
	$usuarios = mysql_query($usuario, $khablasweb) or die(mysql_error());
	$row_usuario = mysql_fetch_assoc($usuarios);

	$tipo = "SELECT Id, Nombre FROM tipo_usuario order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);

	$permiso = "SELECT Id, Nombre FROM accion order by Nombre asc";
	$permisos = mysql_query($permiso, $khablasweb) or die(mysql_error());
	$row_permiso = mysql_fetch_assoc($permisos)
?>


<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1">
	<h2> Modificar Usuario </h2>
	<table>
		<tr>
			<td> <label>Nombre</label> </td>
			<td> <input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Nombre'];?>" /> </td>
			<td> <label>Apellidos</label> </td>
			<td> <input type="text" id="txtapellido" name="txtapellido" placeholder="Apellidos" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Apellidos'];?>" /> </td>
		</tr>
		<tr>
			<td> <label>DNI</label> </td>
			<td> <input type="text" id="txtdni" name="txtdni" placeholder="DNI" size="40" maxlength="9"
				value = "<?php echo $row_usuario['DNI'];?>"/> </td>
			<td> <label>Email</label> </td>
			<td> <input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Email'];?>"/> </td>
		</tr>
		<tr>
			<td> <label>Teléfono</label> </td>
			<td> <input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
				onkeypress="return justNumbers(event);" value = "<?php echo $row_usuario['Telefono'];?>" /> </td>
			<td> <label>Tipo de Usuario</label> </td>
			<td> 
				<select id="txttipo" name="txttipo">
					<?php do{ ?>
						<option value="<?php echo $row_tipo['Id']; ?>" 
							<?php if($row_tipo['Id'] == $row_usuario['Id_tipo']) echo "SELECTED"; ?>
						><?php echo $row_tipo['Nombre']; ?></option>
					<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
				</select> 
			</td>
		</tr>
		<tr>
			<td> <label>Login</label> </td>
			<td> <input type="text" id="txtuser" name="txtuser" placeholder="Login" size="40" maxlength="40" 
				value = "<?php echo $row_usuario['Login'];?>"/> </td>
			<td> <label>Contraseña</label> </td>
			<td> <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Pass'];?>"/> </td>
		</tr>
		<tr>
			<td> <label>Permisos</label> </td>
			<td> <select id="txtpermisos" name="txtpermisos[]" multiple size="5">
					<?php do{ mysql_data_seek($usuarios, 0); ?>
						<option value="<?php echo $row_permiso['Id']; ?>"
							<?php do{ 
								if($row_permiso['Id'] == $row_usuario['Id_Accion']) echo "selected";
							}while($row_usuario = mysql_fetch_assoc($usuarios)); ?> >
						<?php echo $row_permiso['Nombre']; ?></option>
					<?php }while($row_permiso = mysql_fetch_assoc($permisos)); ?>
				</select> </td>
			<td><label>Estado</label></td>
			<?php mysql_data_seek($usuarios, 0); $row_usuario = mysql_fetch_assoc($usuarios); ?>
			<td><select id="txtestado" name="txtestado">
					<option value="1" <?php if( $row_usuario['dado_baja'] == 1 ) echo "selected"; ?> >Dado de Baja</option>
					<option value="0" <?php if( $row_usuario['dado_baja'] == 0 ) echo "selected"; ?> >Activo</option>
				</select> 
			</td>
		</tr>
	</table>
	<div class="botones">
		<input type="hidden" id="txtiduser" name="txtiduser" value ="<?php echo $_POST['id_user']; ?>" />
		<input type="button" id="btnActualizara" name="btnActualizara" value="Actualizar" onclick="Actualizar_user();"/>
	</div>
</form>

