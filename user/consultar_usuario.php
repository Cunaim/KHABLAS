<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo = "SELECT Id, Nombre FROM tipo_usuario order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);

	//aqui recibimos la accion que vamos a realizar despues
	$accion_a_realizar = $_POST['accion'];

?>
<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1">
	<h2> Consulta de Usuario </h2>
	<label>Introduzca al menos un dato, para realizar la busqueda </label>
	<table>
		<tr>
			<td> <label>Nombre</label> </td>
			<td> <input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" size="40" maxlength="40"/> </td>
			<td> <label>Apellidos</label> </td>
			<td> <input type="text" id="txtapellido" name="txtapellido" placeholder="Apellidos" size="40" maxlength="40"/> </td>
		</tr>
		<tr>
			<td> <label>DNI</label> </td>
			<td> <input type="text" id="txtdni" name="txtdni" placeholder="DNI" size="40" maxlength="9"/> </td>
			<td> <label>Email</label> </td>
			<td> <input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40"/> </td>
		</tr>
		<tr>
			<td> <label>Teléfono</label> </td>
			<td> <input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
				onkeypress="return justNumbers(event);" /> </td>
			<td> <label>Tipo de Usuario</label> </td>
			<td> 
				<select id="txttipo" name="txttipo">
					<option value="0">--Seleccione un tipo --</option>
					<?php do{ ?>
						<option value="<?php echo $row_tipo['Id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
					<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
				</select> 
			</td>
		</tr>
	</table>
	<div class="botones">
		<input type="hidden" id="txttipo_consulta" name="txttipo_consulta" value = "<?php echo $accion_a_realizar; ?>" />
		<input type="button" id="btnbuscar" name="btnbuscar" value="Buscar" onclick="consultar_usuario();"/>
	</div>
</form>
<div id="respuesta" name = "respuesta"> </div>

