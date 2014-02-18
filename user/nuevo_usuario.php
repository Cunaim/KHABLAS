<?php
	//introducimos la parte fija de la cabeza
	require_once('../generales/Conexion.php');

	$tipo = "SELECT Id, Nombre FROM tipo_usuario order by Nombre asc";
	$tipos = mysql_query($tipo, $khablasweb) or die(mysql_error());
	$row_tipo = mysql_fetch_assoc($tipos);

	$permiso = "SELECT Id, Nombre FROM accion order by id asc";
	$permisos = mysql_query($permiso, $khablasweb) or die(mysql_error());
	$row_permiso = mysql_fetch_assoc($permisos)
?>

<div class="col-sm-12 header-form"> <h4>Nuevo Usuario</h4> </div>
<div class="col-sm-12 col-form-background">
	<form method="POST" action= "" enctype="multipart/form-data" name="form1" id="form1" class="padding-form">
		<div class="col-sm-6">
            <label>Nombre</label> <br>
			<input type="text" id="txtnombre" name="txtnombre" placeholder="Nombre" size="40" maxlength="40" class="form-general form-text"/> 
             
            <label>DNI</label> <br>
			<input type="text" id="txtdni" name="txtdni" placeholder="DNI" size="40" maxlength="9" class="form-general form-text"/> 
             
            <label>Teléfono</label> <br>
			<input type="tel" id="txttelefono" name="txttelefono" placeholder="Telefono" size="40" maxlength="9"
				onkeypress="return justNumbers(event);"  class="form-general form-text"/> 
                
            <label>Login</label> <br>
			<input type="text" id="txtuser" name="txtuser" placeholder="Login" size="40" maxlength="40" class="form-general form-text"/>  
             
            <label>Permisos</label> <br>
			<select id="txtpermisos" name="txtpermisos[]" multiple size="5" class="form-general form-text">
					<?php do{ ?>
						<option value="<?php echo $row_permiso['Id']; ?>"><?php echo $row_permiso['Nombre']; ?></option>
					<?php }while($row_permiso = mysql_fetch_assoc($permisos)); ?>
				</select> 
            <input type="button" id="btncrear" name="btncrear" value="Crear" onclick="Crear_nuevo_user();" class="btn btn-general-form left"/>
        </div>

        <div class="col-sm-6">
        
            <label>Apellidos</label> <br>
			<input type="text" id="txtapellido" name="txtapellido" placeholder="Apellidos" size="40" maxlength="40" class="form-general form-text"/> 
           
			<label>Email</label> <br>
			<input type="email" id="txtemail" name="txtemail" placeholder="Email" size="40" maxlength="40" class="form-general form-text"/> 
		
			<label>Tipo de Usuario</label><br> 
			<select id="txttipo" name="txttipo" class="form-general form-text" >
				<option value="0">--Seleccione un tipo --</option>
				<?php do{ ?>
					<option value="<?php echo $row_tipo['Id']; ?>"><?php echo $row_tipo['Nombre']; ?></option>
				<?php }while($row_tipo = mysql_fetch_assoc($tipos)); ?>
			</select> 
			 
            <label>Contraseña</label><br> 
			<input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="40" maxlength="40" class="form-general form-text"/> 
        </div>
    </form>
</div>
