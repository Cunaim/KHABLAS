<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <script type="text/javascript" src="js/jquery-1.9.1.js" ></script>
        <script type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript" src="js/js_index.js"></script>
        <!-- para los diferentes jquerys que use, si quieres esto se puede cambiar en la pagina de jqueryui -->
        <link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.css" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.css" />

        <!-- Tipografias Google -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
         <!--Fin Tipografías Google -->
        <title>K-Habls 360</title>
    </head>

    <body>
        <header class="navbar-default navbar-fixed-top header">
        	<div class="container">
            	<div class="navbar-brand">
                	<img class="logo" src="images/logo-khabls.png"/>
                </div>
            </div>
        </div>
        </header>
        <section class="section">
        	<div class="overlay-bg"></div>
        	<div class="container">
            	<div class="col-sm-6">
                	<div class="welcome">
                    	<h1>¡BIENVENIDO <br>
                      A K-HABLS 360!</h1>
                        <p style="text-align:center; font-size:18px;">Accede con tus datos al Universo K-Habls</p>
                    </div>
                
                </div>
            	<img class="full-screen-background-image" src="images/fondo-tienda-yoigo-khabls.jpg" />
                <div class=" col-sm-6">
                	<div class="col-sm-4">
                   	  <div class="speaks">
                        	<p class="speaks-text">Kien <br>eres?</p>
                        </div>
                      <div class="speaks">
                        	<p class="speaks-text">Palabra mágica</p>
                        </div>
                  </div>
                    <div class="col-sm-8">
                    	<form method="POST" action= "" enctype="multipart/form-data" name="form1">
        				
        				  <input type="text" id="txtuser" name="txtuser" placeholder="Usuario" class="form-speaks form-text marg1"/> 
        				  <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" class="form-speaks form-text marg2"/> 
        					
        				  <input type="button" id="btnvalidar" name="btnvalidar" value="ENTRAR" onclick="validar()" class="desk-pull-right btn btn-primary btn-sm" />
        			</form>
                    </div>
                </div>
        	</div>
        </section>

         <!-- esto es la ventana emergente de loading -->
        <div id="dialog-message" title="Procesando">
            <img src="../images/loading.gif" alt="" name="logo" />
            <p id="mensaje"> Procensando su petición </p>
        </div>

        <footer id="footer">
        	<div class="container">
            	<div class="navbar-brand">
                	<ul class="list-inline cinfo-social-buttons">
        					<li><a href="https://twitter.com/ExperienciaSexM" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-15"></i></a></li>
        					<li><a href="https://www.facebook.com/ExperienciaSex" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-15"></i></a></li>
        					
        				</ul>
                </div>
                <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                	<img src="images/logo-khabls-footer.png" class="logo"/>
        		</div>
            
            </div>
        </footer>
    </body>
</html>
