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
		</header>
		<!-- al ser especial esta vez, creamos dos clases una para el Bienvenido y otra para el formulario -->
		<section class="bienvenido">
			<h2>!BIENVENIDO!</h2>
			<h3>Accede con tus datos al Universo K-Habls.</h3>
		</section>

		<section class="formulario">
			<form method="POST" action= "" enctype="multipart/form-data" name="form1">
				<table>
					<tr>
						<td> <h4>Quién Eres?</h4> </td>
						<td> <input type="text" id="txtuser" name="txtuser" placeholder="Usuario" size="30" maxlength="30"/> </td>
					</tr>
					<tr>
						<td> <h4>PALABRAS MÁGICAS</h4> </td>
						<td> <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" size="30" maxlength="30"/> </td>
					</tr>
				</table>
				<input type="button" id="btnvalidar" name="btnvalidar" value="ENTRAR" onclick="validar()" />
			</form>
		</section>
		<!-- footer -->
		<footer>
			<!-- FOOTER_LINK} -->
			<a href="http://www.facebook.es/" target="_blank"><br>FACEBOOK</br></a>
			<a href="http://www.TWITTER.es/" target="_blank"><br>TWITTER</br></a>
			<a href="http://www.LINKEDIN.es/" target="_blank"><br>LINKEDIN</br></a>
		</footer>
	<!-- esto es la ventana emergente de loading -->
	<div id="dialog-message" title="Accediendo">
		<img src="images/loading.gif" alt="" name="logo" />
		<p id="mensaje"> Procensando su petición </p>
		
	</div>

	</body>
</html>