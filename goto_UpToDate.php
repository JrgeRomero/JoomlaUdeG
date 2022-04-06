<?php
//Inicio la sesión 
//session_start(); 

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

require_once JPATH_BASE . '/includes/framework.php';

// *** CREAR VARIABLES DE SESION (PRUEBA)
$mainframe = JFactory::getApplication('site');
$mainframe->initialise();


if (JFactory::getUser()->id == 0){
	header("Location: index.php"); 
}

include('BDerecho.js');

?>

<?php
	$h = 739;
	$g = 34426334;
	$d = "356983_1PHP";
	$n = time();
	$c = gmdate("imdH", $n);
	$c = $c - 10000;
	$c = ($c * $h) - $g;
	$urlArgs = "";
	$prefix = "?";
	foreach($_SERVER as $key=>$value) {
		if ($key=="QUERY_STRING") {
				$urlArgs = "?" . $value;
				break;
		}
	}
?>
<html>
	<head>
		<script language="javascript">
		function go() {
			var key = document.getElementById("key").value;
			
			if (!isNaN(key)) {
				document.getElementById('submitButton').value=
					"Redirecting to " + document.uptodate.action + " ... please wait.";
				document.uptodate.submit();
			} else {
				alert("This UpToDate portal is not installed correctly.  Please contact your systems administrator");
				return false;
			}
		}
		</script>
	</head>
	<body onload="go();">
		<form method="POST" action="http://www.uptodate.com/portal-login<?php echo $urlArgs ?>" name="uptodate" onsubmit="go();">
			<input type="hidden" value="<?php echo $d ?>" name="portal">
			<input type="hidden" value="<?php echo $c ?>" name="key" id="key">
			<input type="submit" value="UpToDate" id="submitButton">
		</form>
	</body>
</html>