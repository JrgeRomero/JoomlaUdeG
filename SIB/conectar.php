<?php
$servidor="localhost";
$bd = "wdgsib";
$usuario="root"; 
$pass="lMz17-48";
$conn=mysql_connect($servidor,$usuario, $pass) or die (mysql_error("Error al conectar a la BD"));
mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
?>
