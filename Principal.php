<?php
	//introducimos la parte fija de la cabeza
	require_once('generales/Cabecera.php');
?>

<section class="formulario" id="formulario">
	<form>
	<h2> BIENVENIDO </h2>
	<p> Aqui ponemos cualquier cosa que se te ocurre a modo bienvenida </p>
</section>

<!-- esto es la ventana emergente de loading -->
<div id="dialog-message" title="Accediendo">
	<img src="images/loading.gif" alt="" name="logo" />
	<p id="mensaje"> Procensando su petición </p>
	
</div>

<?php
	//introducimos la parte fija de los pies
	require_once('generales/footer.php');
?>