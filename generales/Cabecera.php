<?php 
require_once('Conexion.php');

$tipo_user = $_SESSION['Tipo'];
$id_usur = $_SESSION['Id'];
if(isset($_GET['pos']))
	$indice_menu = $_GET['pos'];
else
	$indice_menu = 0;

$menu = "SELECT seccion.* FROM seccion inner join tipo_seccion on tipo_seccion.Id_seccion = seccion.id 
where tipo_seccion.Id_tipo = '$tipo_user'";
$menus = mysql_query($menu, $khablasweb) or die(mysql_error());
$row_menus = mysql_fetch_assoc($menus);

$submenu = "SELECT submenus.Nombre, submenus.URL, submenus.clases, submenus.id_accion from submenus
	inner join permisos on permisos.id_accion = submenus.id_accion
	where permisos.id_Usuario = '$id_usur' 
	and submenus.id_seccion = '$indice_menu' order by submenus.id asc";
$submenus = mysql_query($submenu, $khablasweb) or die(mysql_error());
$row_submenus = mysql_fetch_assoc($submenus);
$nsubmenus = mysql_num_rows($submenus);


?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>K-Habls 360</title>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="css/Marta.css" type="text/css" media="all"> -->
		<script type="text/javascript" src="../js/jquery-1.9.1.js" ></script>
		<script type="text/javascript" src="../js/modernizr.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom.js"></script>
		<script type="text/javascript" src="../js/modernizr.js"></script>
		<script type="text/javascript" src="../js/js_user.js"></script>
		<script type="text/javascript" src="../js/js_generales.js"></script>
		<!-- para los diferentes jquerys que use, si quieres esto se puede cambiar en la pagina de jqueryui -->
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.10.4.custom.css" media="all">
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/fontawesome/css/font-awesome.css" />
		<!-- Tipografias Google -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
         <!--Fin Tipografías Google -->
	</head>
	<body>
		<header class="navbar-default navbar-fixed-top header">
			<div class="container">
            	<div class="navbar-brand">
                	<img class="logo" src="../images/logo-khabls.png"/>
                </div>
				<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
	        		<ul class="nav navbar-nav">
						<?php do{ ?>
		                	<li>
		                		<a href="../<?php echo $row_menus['URL']; ?>" ><?php echo $row_menus['Nombre']; ?></a>
		                	</li>
		                <?php }while($row_menus = mysql_fetch_assoc($menus)); ?>
		                	<li>
		                		<a href="../generales/Salir.php" >Salir</a>
		                	</li>
	            	</ul>
	            </div>
	            <img class="full-screen-background-image" src="../images/fondo-tienda-yoigo-khabls.jpg" />    </div>
            </div>
		</header>
		<!-- al ser especial esta vez, creamos dos clases una para el Bienvenido y otra para el formulario -->
		<section class="section">
			<div class="overlay-bg"></div>
        	<article class="container">
    			<div class="col-sm-4">
				<?php if($nsubmenus != 0) { ?>
					<ul class="nav nav-pills nav-stacked">
						<?php do{ ?>
							<li>
								<a onclick="abrir_enlace_user('<?php echo $row_submenus['URL']; ?>','<?php echo $row_submenus['id_accion']; ?>')" >
								<i class="<?php echo $row_submenus['clases']; ?>"></i><?php echo $row_submenus['Nombre']; ?></a>
							</li>
						<?php }while($row_submenus = mysql_fetch_assoc($submenus)); ?>
					</ul>
				<?php } ?>
				</div>
			
