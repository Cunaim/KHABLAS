<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo = "SELECT Id, Nombre FROM tipo_cliente order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);

	$permiso = "SELECT Id, Nombre FROM accion order by Nombre asc";
	$permisos = mysql_query($permiso, $khablasweb) or die(mysql_error());
	$row_permiso = mysql_fetch_assoc($permisos)

?>


<div class="col-sm-12 header-form"> <h4>Nuevo Usuario</h4> </div>
<div class="col-sm-12 col-form-background">
	<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1">
		<br>
		<table>
			<tr>
				<td><label>Tipo de Cliente</label></td>
				<td>
					<select id = "txttipo_cliente" name = "txttipo_cliente" onchaged="seleccionar_cliente()" 
						class="form-general form-text">
						<option value="0"> --Seleccione un Cliente-- </option>
						<?php do{ ?>
							<option value="<?php echo $row_tipo['Id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
						<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
					</select>
				</td>
			</tr>
			<tr style="display:none">
				<td><label>CIF asociado</label></td>
				<td>
					<select id = "txtCIF_user" name = "txtCIF_user" class="form-general form-text">
						<option value="0"> --Seleccione un CIF-- </option>
					</select>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td> <label>Matricula / Nombre Comercial</label> </td>
				<td> <input type="text" id="txtnombre" name="txtnombre" placeholder="Matricula o Nombre Comercial" 
					size="40" maxlength="40" class="form-general form-text"/> </td>
				<td> <label>CIF</label> </td>
				<td> <input type="text" id="txtCIF" name="txtCIF" placeholder="CIF" size="40" maxlength="9"
					class="form-general form-text"/> </td>
			</tr>
			<tr>
				<td> <label>Telefono</label> </td>
				<td> <input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
					onkeypress="return justNumbers(event);" class="form-general form-text"/> </td>
				<td> <label>Email</label> </td>
				<td> <input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40"
					class="form-general form-text"/> </td>
			</tr>
			<tr>
				<td> <label>Direccion</label> </td>
				<td> <input type="text" id="txtdireccion" name="txtdireccion" placeholder="Direccion" size="40" maxlength="40"
					class="form-general form-text"/> </td>
				<td> <label>Localidad</label> </td>
				<td> <input type="text" id="txtlocalidad" name="txtlocalidad" placeholder="Localidad" size="40" maxlength="40"
					class="form-general form-text"/> </td>
			</tr>
			<tr>
				<td> <label>C.Postal</label> </td>
				<td> <input type="text" id="txtCPostal" name="txtCPostal" placeholder="CP" size="40" maxlength="5"
					class="form-general form-text"/> </td>
				<td> <label>Contraseña</label> </td>
				<td> <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40"
					class="form-general form-text"/> </td>
			</tr>
		</table>
		<div class="botones">
			<input type="button" id="btncrear" name="btncrear" value="Crear" onclick="Crear_nuevo_cliente();"
				class="btn btn-general-form left"/>
		</div>
	</form>
</div>
