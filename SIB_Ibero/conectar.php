<?php
	$servidor2="localhost";
	$bd2 = "iberousuarios";
	$usuario2="root"; 
	$pass2="lMz17-48";
	$conn2=mysql_connect($servidor2,$usuario2, $pass2) or die (mysql_error("Error al conectar a la BD"));
	mysql_select_db($bd2,$conn2) or die (mysql_error("Error al seleccionar la BD"));
	$servidor="localhost";
	$bd = "iberosib";
	$usuario="root"; 
	$pass="lMz17-48";
	$conn=mysql_connect($servidor,$usuario, $pass) or die (mysql_error("Error al conectar a la BD"));
	mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
?>
