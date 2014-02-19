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
	$row_permiso = mysql_fetch_assoc($permisos);

	//obtenemos los valores necesario para la vuelta
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$dni = $_POST['dni'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$tipo = $_POST['tipo'];
?>



<div class="col-sm-12 header-form"> <h4>Modificar Usuario</h4> </div>
<div class="col-sm-12 col-form-background">
	<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1" class="padding-form">
		<div class="col-sm-6">
			<label>Nombre</label> <br>
			<input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Nombre'];?>" class="form-general form-text" />

			<label>DNI</label> <br> 
			<input type="text" id="txtdni" name="txtdni" placeholder="DNI" size="40" maxlength="9"
				value = "<?php echo $row_usuario['DNI'];?>" class="form-general form-text"/> 

			<label>Teléfono</label> <br> 
			<input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
				onkeypress="return justNumbers(event);" value = "<?php echo $row_usuario['Telefono'];?>" 
				class="form-general form-text"/> 
			 				
			<label>Login</label> <br> 
			<input type="text" id="txtuser" name="txtuser" placeholder="Login" size="40" maxlength="40" 
				value = "<?php echo $row_usuario['Login'];?>" class="form-general form-text"/> 

			<label>Permisos</label> <br> 
			<select id="txtpermisos" name="txtpermisos[]" multiple size="5" class="form-general form-text">
				<?php do{ mysql_data_seek($usuarios, 0); ?>
					<option value="<?php echo $row_permiso['Id']; ?>"
						<?php do{ 
							if($row_permiso['Id'] == $row_usuario['Id_Accion']) echo "selected";
						}while($row_usuario = mysql_fetch_assoc($usuarios)); ?> >
					<?php echo $row_permiso['Nombre']; ?></option>
				<?php }while($row_permiso = mysql_fetch_assoc($permisos)); ?>
			</select> 

			<input type="hidden" id="txtiduser" name="txtiduser" value ="<?php echo $_POST['id_user']; ?>" />
			<input type="button" id="btnActualizara" name="btnActualizara" value="Actualizar" onclick="Actualizar_user();"
				class="btn btn-general-form left"/>
			<input type="button" id="btnvolver" name="btnvolver" value="Volver" onclick="volver_consultar_user();"
				class="btn btn-general-form left"/>
		</div>

    	<div class="col-sm-6">
		<!--cambiamos de columna -->
			<?php //Reiniciamos El valor de las variables para asi tener valores
			mysql_data_seek($usuarios, 0); $row_usuario = mysql_fetch_assoc($usuarios); ?>
			<label>Apellidos</label> <br> 
			<input type="text" id="txtapellido" name="txtapellido" placeholder="Apellidos" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Apellidos'];?>" class="form-general form-text" /> 

			<label>Email</label> <br> 
			<input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Email'];?>" class="form-general form-text"/> 

			<label>Tipo de Usuario</label> <br> 
			<select id="txttipo" name="txttipo" class="form-general form-text">
				<?php mysql_data_seek($usuarios, 0); $row_usuario = mysql_fetch_assoc($usuarios);
				do{  ?>
					<option value="<?php echo $row_tipo['Id']; ?>" 
						<?php if($row_tipo['Id'] == $row_usuario['Id_tipo']) echo "SELECTED"; ?>
					><?php echo $row_tipo['Nombre']; ?></option>
				<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
			</select> 

			<label>Contraseña</label> <br> 
			<input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40"
				value = "<?php echo $row_usuario['Pass'];?>" class="form-general form-text"/> 

			<label>Estado</label> <br>
			<?php mysql_data_seek($usuarios, 0); $row_usuario = mysql_fetch_assoc($usuarios); ?>
			<select id="txtestado" name="txtestado" class="form-general form-text">
				<option value="1" <?php if( $row_usuario['dado_baja'] == 1 ) echo "selected"; ?> >Dado de Baja</option>
				<option value="0" <?php if( $row_usuario['dado_baja'] == 0 ) echo "selected"; ?> >Activo</option>
			</select>
		</div>
		<!--guardamos las variables para hacer el volver -->
		<input type='hidden' id='txtnombre_vuelta' name='txtnombre_vuelta' 
			value = "<?php if($_POST['nombre'] != "Cu4l0u13r4") echo $_POST['nombre']; else echo 'Cu4l0u13r4'; ?> " />
		<input type='hidden' id='txtapellido_vuelta' name='txtapellido_vuelta' 
			value = "<?php if($_POST['apellidos'] != "Cu4l0u13r4") echo $_POST['apellidos']; else echo 'Cu4l0u13r4'; ?>" />
		<input type='hidden' id='txtdni_vuelta' name='txtdni_vuelta' 
		value = "<?php if($_POST['dni'] != "Cu4l0u13r4") echo $_POST['dni']; else echo 'Cu4l0u13r4'; ?> " />
		<input type='hidden' id='txtemail_vuelta' name='txtemail_vuelta' 
			value = "<?php if($_POST['email'] != "Cu4l0u13r4") echo $_POST['email']; else echo 'Cu4l0u13r4'; ?> " />
		<input type='hidden' id='txttelefono_vuelta' name='txttelefono_vuelta' 
			value = "<?php if($_POST['telefono'] != "Cu4l0u13r4") echo $_POST['telefono']; else echo 'Cu4l0u13r4'; ?> " />
		<input type='hidden' id='txttipo_vuelta' name='txttipo_vuelta' 
			value = "<?php if($_POST['tipo'] != "Cu4l0u13r4") echo $_POST['tipo']; else echo '0'; ?> " />
    </form>
</div>

