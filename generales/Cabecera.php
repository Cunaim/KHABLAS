<?php 
require_once('Conexion.php');

$tipo_user = $_SESSION['tipo'];
$id_usur = $_SESSION['Id'];

$menu = "SELECT seccion.* FROM seccion inner join tipo_seccion on tipo_seccion.Id_seccion = seccion.id 
where tipo_seccion.Id_tipo = '$tipo_user'";
$menus = mysql_query($menu, $khablasweb) or die(mysql_error());
$row_menus = mysql_fetch_assoc($menus);

$submenu = "SELECT submenu.nombre, submenu.URL from submenu 
	inner join permisos on permisos.id_accion = submenu.id_accion
	where permisos.id_Usuario = '$id_usur' 
	and submenu.id_seccion = '".$row_menus['id']."'";
$submenus = mysql_query($submenu, $khablasweb) or die(mysql_error());
$row_submenus = mysql_fetch_assoc($submenus);


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>K-Habls 360</title>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="css/Marta.css" type="text/css" media="all"> -->
		<script type="text/javascript" src="js/jquery-1.9.1.js" ></script>
		<script type="text/javascript" src="js/modernizr.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
		<script type="text/javascript" src="js/modernizr.js"></script>
		<script type="text/javascript" src="js/js_index.js"></script>
		<!-- para los diferentes jquerys que use, si quieres esto se puede cambiar en la pagina de jqueryui -->
		<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.css" type="text/css" media="all">
	</head>
	<body>
		<header>
			<img src="images/logo_Khablas.png" alt="" name="logo" />
			<ul>
				<?php do{ ?>
                	<li><a href="../<?php echo $row_menus['URL']; ?>" ><?php echo $row_menus['Nombre']; ?></a></li>
                <?php }while($row_menus = mysql_fetch_assoc($menus)); ?>
            </ul>
		</header>
		<!-- al ser especial esta vez, creamos dos clases una para el Bienvenido y otra para el formulario -->
		<section class="submenu">
			<ul>
				<?php do{ ?>
					<li><a href="<?php echo $row_submenus['URL']; ?>" ><?php echo $row_submenus['Nombre']; ?></a></li>
				<?php }while($row_submenus = mysql_fetch_assoc($submenus)); ?>
			</ul>
		</section>