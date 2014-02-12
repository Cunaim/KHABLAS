<?php 
	include "conexion/conexion.php"; 
	date_default_timezone_set('Europe/Madrid');
	// *** Validate request to login to this site.
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

	$MM_redirectLoginFailed = "Index.php"; //si mal volvemos al comienzo

	if($_POST['txtuser'] == "" || $_POST['txtpass'] == "")
	{
		session_destroy();
		header("Location: ". $MM_redirectLoginFailed );
	}

	if (isset($_POST['txtuser']) && isset($_POST['txtpass'])) 
	{
		$loginUsername = addslashes($_POST['txtuser']);
		$password = addslashes($_POST['txtpass']);
		//vamos a quitar caracteres extraños
		$CU = count(explode(" ", $loginUsername));
		$CP = count(explode(" ", $password));

		if ($CU =! 1 || $CP != 1)
		{
			//si tenemos mas de una palabra volvemos al index signifca que ahi algo mal
			header("Location: ". $MM_redirectLoginFailed );
		}

		$MM_fldUserAuthorization = "";
		$Ope_redirectLoginSuccess = "Ope/index.php"; //si todo correcto vamos a la parte de operador
		$lab_redirectLoginSuccess = "lab/index.php"; //si todo correcto vamos a la parte de Lab
		$MM_redirecttoReferrer = false;

 
 		$LoginRS_query="SELECT id,login,password,nombre,tipo,tipo_sfid,tipo_cif,tipo_master,tipo_laboratorio, 
 		baja, penalizacion FROM Usuarios WHERE login='$loginUsername' AND password='$password'";
		$LoginRS = mysql_query($LoginRS_query, $reciclagoweb) or die(mysql_error());
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

		if ($loginFoundUser == 1 && $row_LoginRS['login'] == $loginUsername && $row_LoginRS['baja'] == 0
			&& $row_LoginRS['password'] == $password) {	
			//comprobamos que el login optenido es el mismo que el login dado	
			//register the session variables
			$_SESSION['User'] = $row_LoginRS['login'];
			$_SESSION['pass'] = $row_LoginRS['password'];
			$_SESSION['nombre'] = $row_LoginRS['nombre'];
			$_SESSION['Id'] = $row_LoginRS['id'];
			$_SESSION['sfid'] = $row_LoginRS['tipo_sfid'];
			$_SESSION['cif'] = $row_LoginRS['tipo_cif'];
			$_SESSION['master'] = $row_LoginRS['tipo_master'];
			$_SESSION['laboratorio'] = $row_LoginRS['tipo_laboratorio'];
			$_SESSION['pedido'] = "";
			$_SESSION['tipo'] = $row_LoginRS['tipo'];
			$_SESSION['penalizacion'] = $row_LoginRS['penalizacion'];

			if($row_LoginRS['tipo'] == 6 || $row_LoginRS['tipo'] == 5 )
			{
				$Login_correcto="INSERT into entrada (usuario, ip, fecha_entrada, intentos,entrada) values 
				('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1','CORRECTA')";
				$Login_correctos = mysql_query($Login_correcto, $reciclagoweb) or die(mysql_error());
				header("Location: ". $Ope_redirectLoginSuccess );
			}
			else if($row_LoginRS['tipo'] < 5 ||  $row_LoginRS['tipo'] > 6)
			{
				$Login_correcto="INSERT into entrada (usuario, ip, fecha_entrada, intentos,entrada) values 
				('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1','CORRECTA')";
				$Login_correctos = mysql_query($Login_correcto, $reciclagoweb) or die(mysql_error());
				header("Location: ". $lab_redirectLoginSuccess );
			}
				
		}
		else 
		{
				//1º comprobamos si ha intentado entrar hoy
			$Login="SELECT id, intentos from entrada where usuario like '%".$loginUsername."%' and 
				fecha_entrada >= '".date('Y-m-d')." 00:00:00' and fecha_entrada <= '".date('Y-m-d')." 23:59:59'";
			$Logins = mysql_query($Login, $reciclagoweb) or die(mysql_error());
			$row_Login = mysql_fetch_assoc($Logins);
			$nlogin = mysql_num_rows($Logins);

			if($nlogin > 0)
			{
				$intentos = $row_Login['intentos']+1;
				$Login_incorrecto="UPDATE entrada set intentos = '".$intentos."', entrada = 'FALLIDA' where id = '".$row_Login['id']."'";
			}
			else
			{
				$Login_incorrecto="INSERT into entrada (usuario, ip, fecha_entrada, intentos, entrada) values 
				('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1', 'FALLIDA')";
			}
			
			$Login_incorrectos = mysql_query($Login_incorrecto, $reciclagoweb) or die(mysql_error());
			header("Location: ". $MM_redirectLoginFailed );
		}
	}
	else{
		//1º comprobamos si ha intentado entrar hoy
		$Login="SELECT id, intentos from entrada where usuario like '%".$loginUsername."%' and 
			fecha_entrada >= '".date('Y-m-d')." 00:00:00' and fecha_entrada <= '".date('Y-m-d')." 23:59:59'";
		$Logins = mysql_query($Login, $reciclagoweb) or die(mysql_error());
		$row_Login = mysql_fetch_assoc($Logins);
		$nlogin = mysql_num_rows($Logins);

		if($nlogin > 0)
		{
			$intentos = $row_Login['intentos']+1;
			$Login_incorrecto="UPDATE entrada set intentos = '".$intentos."', entrada = 'FALLIDA' where id = '".$row_Login['id']."'";
		}
		else
		{
			$Login_incorrecto="INSERT into entrada (usuario, ip, fecha_entrada, intentos,entrada) values 
			('".$loginUsername."','".$realip."','".date('Y-m-d H:i:s')."','1','FALLIDA')";
		}
		
		$Login_incorrectos = mysql_query($Login_incorrecto, $reciclagoweb) or die(mysql_error());

		header("Location: ". $MM_redirectLoginFailed );
	}
?>