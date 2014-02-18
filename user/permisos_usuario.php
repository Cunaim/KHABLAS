<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo = "SELECT Id, Nombre FROM tipo_usuario order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);

	//aqui recibimos la accion que vamos a realizar despues
	$accion_a_realizar = $_POST['accion'];

?>
<div class="col-sm-12 header-form"> <h4>Consultar Usuario</h4> </div>
<div class="col-sm-12 col-form-background">
	<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1" class="padding-form">
		<div class="col-sm-6">
            <label>Tipo Usuario</label> <br>
			<select id="txttipo" name="txttipo" class="form-general form-text" onchange="tipo_usuario_permisos()">
				<option value="0">--Seleccione un tipo --</option>
				<?php do{ ?>
					<option value="<?php echo $row_tipo['Id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
				<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
			</select> 

			<input type="button" id="btnActualizar" name="btnActualizar" value="Actualizar" onclick="actualizar_permisos_tipo()"
				class="btn btn-general-form left"/>
		</div>

		<div class="col-sm-6" style="visibility:hidden" id="div_permisos">
            <label>Permisos</label> <br>
			<select id="txtpermisos" name="txtpermisos[]" class="form-general form-text" multiple  >
				<option value="0">--Seleccione los Permisos -- </option>
			</select> 
        </div>
    </form>
</div>
