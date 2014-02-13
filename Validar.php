<?php 
	include "conexion/conexion.php"; 
	date_default_timezone_set('Europe/Madrid');
	// *** Validate request to login to this site.
	$MM_redirectLoginFailed = "Index.php"; //si mal volvemos al comienzo
	$MM_fldUserAuthorization = "";
	$MM_redirecttoReferrer = false;

	session_start();

	$loginFormAction = $_SERVER['PHP_SELF'];
	if (isset($accesscheck)) {
		$GLOBALS['PrevUrl'] = $accesscheck;
		session_register('PrevUrl');
	}

	if(isset($_SESSION['User']))
	{
		// Finalmente, destruir la sesión.
		session_destroy();
	}

	if($_POST['usuario'] == "" || $_POST['pass'] == "")
	{
		session_destroy();
		echo 0; //no pasamos la validacion
	}

	if (isset($_POST['usuario']) && isset($_POST['pass'])) 
	{
		$loginUsername = addslashes($_POST['usuario']);
		$password = addslashes($_POST['pass']);
		//vamos a quitar caracteres extraños
		$CU = count(explode(" ", $loginUsername));
		$CP = count(explode(" ", $password));

		if ($CU =! 1 || $CP != 1)
		{
			//si tenemos mas de una palabra volvemos al index signifca que ahi algo mal
			echo 0; //fallo la valicacion
		}



 		//buscamos la coincidencia
 		$LoginRS_query="SELECT id,Login,Pass,Nombre, Id_tipo, baja FROM usuarios WHERE Login='$loginUsername' AND Pass ='$password'";
		$LoginRS = mysql_query($LoginRS_query, $khablasweb) or die(mysql_error());
		$row_LoginRS = mysql_fetch_assoc($LoginRS);
		$loginFoundUser = mysql_num_rows($LoginRS);

		if ($_SERVER) 
		{  
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
		        $realip =  $_SERVER['HTTP_CLIENT_IP'];
		    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		        $realip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else 
		    	$realip = $_SERVER['REMOTE_ADDR'];
		}  

		if ($loginFoundUser == 1 && $row_LoginRS['Login'] == $loginUsername && $row_LoginRS['baja'] == 0
			&& $row_LoginRS['Pass'] == $password) {	
			//comprobamos que el login optenido es el mismo que el login dado	
			//register the session variables
			$_SESSION['user'] = $row_LoginRS['Login'];
			$_SESSION['pass'] = $row_LoginRS['Pass'];
			$_SESSION['nombre'] = $row_LoginRS['Nombre'];
			$_SESSION['Id'] = $row_LoginRS['id'];
			$_SESSION['tipo'] = $row_LoginRS['Id_tipo'];

			$Login_correcto="INSERT into entrada (usuario, ip, fecha_entrada, intentos, entrada) values 
			('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1','CORRECTA')";
			$Login_correctos = mysql_query($Login_correcto, $khablasweb) or die(mysql_error());

			//todo ha ido correcto
			echo 1;
		}
		else 
		{
				//1º comprobamos si ha intentado entrar hoy
			$Login="SELECT id, intentos from entrada where usuario like '%".$loginUsername."%' and 
				fecha_entrada >= '".date('Y-m-d')." 00:00:00' and fecha_entrada <= '".date('Y-m-d')." 23:59:59'";
			$Logins = mysql_query($Login, $khablasweb) or die(mysql_error());
			$row_Login = mysql_fetch_assoc($Logins);
			$nlogin = mysql_num_rows($Logins);

			if($nlogin > 0)
			{
				$intentos = $row_Login['intentos'] + 1;
				$Login_incorrecto="UPDATE entrada set intentos = '".$intentos."', entrada = 'FALLIDA' 
					where id = '".$row_Login['id']."'";
			}
			else
			{
				$Login_incorrecto="INSERT into entrada (usuario, ip, fecha_entrada, intentos, entrada) values 
				('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1', 'FALLIDA')";
			}
			
			$Login_incorrectos = mysql_query($Login_incorrecto, $khablasweb) or die(mysql_error());

			//la validacion no ha sido correcta
			echo 0;
		}
	}
?>