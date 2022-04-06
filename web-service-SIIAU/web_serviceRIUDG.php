<?php
session_start(); 
// declaracion de variables
require_once('lib/nusoap.php');
//$params["usuario"] = $credentials['username'];
$params["usuario"] = $_REQUEST['usuario']; 
$params["password"] = $_REQUEST['password'];
$params["key"] = "UdGSIIAUWebServiceValidaUsuario";
//$params["key"] = "UdGSIIAUWebServiceDatosUsuario";
$client  = new jcrdsoapclient('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
//$client  = new jcrdsoapclient('http://148.202.105.181/WebServiceLogon/WebServiceLogon?WSDL');

//$respuesta = $client->call("datosUsuario", $params);
$respuesta = $client->call("valida", $params);
echo "-:"; 
echo $respuesta; 
echo ":-";
list($status, $codigo, $nombre, $var1, $var2) = explode(",", $respuesta);
//echo ":";
//echo $status; echo $codigo; echo $nombre; echo $var1; echo $var2;
//echo ":";
?>
