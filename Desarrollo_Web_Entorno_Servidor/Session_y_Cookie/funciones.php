<?php
/* La function comprobarSesion() abre una sesion y comprueba que existe una variable $_SESSION["usuario"]:
        1. Si existe, carga los datos de la sesion en una variable $usuario
        2. Si no existe, nos redirige a la pagina login.php y para por completo este script  
*/
function comprobarSesion()
{
	session_start(); 
	if (isset($_SESSION["usuario"]))
	{
		$usuario = $_SESSION["usuario"];
	}
	else		
	{ 
		header( "Location: login.php" );
		exit; 
	}
}

//La function cerrarSesion() destruye la sesión por completo.
function eliminarSesion()
{
	//Elimnina los datos del array de sesión
	$_SESSION=array();

	//Elimina las cookies de sesión
	if(ini_get("session.use_cookies")){
		$params = session_get_cookie_params();
		setcookie(session_name(),'',time()-42000,
			$params["path"],$params["domain"],
			$params["secure"],$params["httponly"]   
		);
	}

	//Destruye la sesión
	session_destroy();

	//Borra la cookie "horario"
	setcookie("horario", "", time()-42000);

	//Redirigimos a la página de login
	header( "Location: login.php" );
	exit; 
}
?>