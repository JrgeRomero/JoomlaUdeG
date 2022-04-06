<?php
	define('_JEXEC', 1);

	if (file_exists(__DIR__ . '/defines.php'))
	{
		include_once __DIR__ . '/defines.php';
	}

	if (!defined('_JDEFINES'))
	{
		define('JPATH_BASE', __DIR__);
		require_once JPATH_BASE . '/includes/defines.php';
	}

	echo "$_SESSION";
	require_once JPATH_BASE . '/includes/framework.php';

	/* Create the Application */
	$mainframe =& JFactory::getApplication('site');
	$user = JFACTORY::getUser();
	//var_dump($user);

	/*include('web-service-SIIAU/cliente_wdg.php');
		if($respuesta){
			$_SESSION['codigosiiau'] = $user->username;
			$_SESSION['nombresiiau'] = $nombre;
			$_SESSION["autentificado"] = "SI";
			echo "Respuesta:".$respuesta;
			$user->username = "siiau";
			$user->password = "userbd2015SIIAU";
			echo "$user->username";
		}*/

	/* Make sure we are logged in at all. */
	if (JFactory::getUser()->id == 0)
	    die("Access denied: login required.");
	else
	    echo 'Logged in as "' . JFactory::getUser()->username . '"';
?>