<?php
	//introducimos la parte fija de la cabeza
	require_once('generales/Cabecera.php');
?>

<section class="section" id="formulario">
	<div class="overlay-bg"></div>
	<div class="container">
    	<div class="col-sm-6">
        	<div class="ppal-speaks">
            	<h1 class="ppal-speaks-text">YA ESTÁS DENTRO DE <br>
              K-HABLS 360</h1>
                <p class="ppal-speaks-text" style="text-align:center; font-size:18px;">Ahora tienes que elegir qué quieres hacer</p>
            </div>
        
        </div>
    	<div class=" col-sm-6">
        	<div class="col-sm-4">
        		<?php mysql_data_seek($menus,0);
        		while($row_menus = mysql_fetch_assoc($menus)){ ?>
           	  	<div class="ppal-speaks movspeaks-1">
                	<a class="ppal-speaks-text" href="../<?php echo $row_menus['URL']; ?>">
                		<?php echo $row_menus['Nombre']; ?></a>
                </div>
                <?php } ?>
          </div>
            <div class="col-sm-8">
            	
            </div>
        </div>
	</div>
</section>

<?php
	//introducimos la parte fija de los pies
	require_once('generales/footer.php');
?>