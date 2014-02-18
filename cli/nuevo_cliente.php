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
	<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1" class="padding-form">
		<div class="col-sm-6">
			<label>Tipo de Cliente</label>
			<select id = "txttipo_cliente" name = "txttipo_cliente" onchange="seleccionar_cliente()" 
				class="form-general form-text">
				<option value="0"> --Tipo de Cliente-- </option>
				<?php do{ ?>
					<option value="<?php echo $row_tipo['Id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
				<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
			</select>
		</div>
		<div class="col-sm-6" id="div_cif_asociado" style="visibility:hidden">
			<label id="lbl_cif_asociado">CIF asociado</label>
			<select id = "txtCIF_user" name = "txtCIF_user" class="form-general form-text">
				<option value="0"> --Seleccione un CIF-- </option>
			</select>
		</div>
		<div class="col-sm-6">
			<label id="lbl_cambio">Nombre Comercial</label> <br>
			<input type="text" id="txtnombre" name="txtnombre" placeholder="Matricula o Nombre Comercial" 
					size="40" maxlength="40" class="form-general form-text"/> 

			<label>Telefono</label> <br>
			<input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
				onkeypress="return justNumbers(event);" class="form-general form-text"/> 
			 
			<label>Direccion</label> <br>
			<input type="text" id="txtdireccion" name="txtdireccion" placeholder="Direccion" size="40" maxlength="40"
				class="form-general form-text"/>

			<label>C.Postal</label> <br>
			<input type="text" id="txtCPostal" name="txtCPostal" placeholder="CP" size="40" maxlength="5"
				class="form-general form-text"/> 

			<input type="button" id="btncrear" name="btncrear" value="Crear" onclick="Crear_nuevo_cliente();"
				class="btn btn-general-form left"/>

		</div>
		<div class="col-sm-6">
			<label>CIF</label> <br>
			<input type="text" id="txtCIF" name="txtCIF" placeholder="CIF" size="40" maxlength="9"
				class="form-general form-text"/>

			<label>Email</label> <br>
			<input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40"
				class="form-general form-text"/>

			<label>Localidad</label> <br>
			<input type="text" id="txtlocalidad" name="txtlocalidad" placeholder="Localidad" size="40" maxlength="40"
				class="form-general form-text"/> 

			<label>Contraseña</label> <br>
			<input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40"
				class="form-general form-text"/> 
		</div>
	</form>
</div>
