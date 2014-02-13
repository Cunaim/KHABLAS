<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo = "SELECT Id, Nombre FROM tipo_usuario order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);
?>


<form method="POST" action= "" enctype="multipart/form-data" name="form1">
	<h2> Nuevo Usuario </h2>
	<table>
		<tr>
			<td> <label>Nombre</label> </td>
			<td> <input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" size="40" maxlength="40"/> </td>
			<td> <label>Apellidos</label> </td>
			<td> <input type="text" id="txtApellido" name="txtApellido" placeholder="Apellidos" size="40" maxlength="40"/> </td>
		</tr>
		<tr>
			<td> <label>DNI</label> </td>
			<td> <input type="text" id="txtdni" name="txtdni" placeholder="DNI" size="40" maxlength="9"/> </td>
			<td> <label>Email</label> </td>
			<td> <input type="email" id="txtemail" name="txtEmail" placeholder="Email" size="40" maxlength="40"/> </td>
		</tr>
		<tr>
			<td> <label>Teléfono</label> </td>
			<td> <input type="tel" id="txttelefono" name="txtTelefono" placeholder="Telefono" size="40" maxlength="9"/> </td>
			<td> <label>Tipo de Usuario</label> </td>
			<td> 
				<select id="txttipo" name="txttipo">
					<option value="0">--Seleccione un tipo --</option>
					<?php do{ ?>
						<option value="<?php echo $row_tipo['id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
					<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
				</select> 
			</td>
		</tr>
		<tr>
			<td> <label>Login</label> </td>
			<td> <input type="text" id="txtlogin" name="txtLogin" placeholder="Login" size="40" maxlength="40"/> </td>
			<td> <label>Contraseña</label> </td>
			<td> <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40"/> </td>
		</tr>
	</table>
	<div class="botones">
		<input type="button" id="btncrear" name="btncrear" value="Crear" onclick="Crear_nuevo_user();"/>
	</div>
</form>

