<?php
session_start(); 
// declaracion de variables
require_once('lib/nusoap.php');
//$params["usuario"] = $credentials['username'];
$params["usuario"] = $_REQUEST['usuario']; 
//$params["password"] = $_REQUEST['password'];
//$params["key"] = "UdGSIIAUWebServiceValidaUsuario";
$params["key"] = "UdGSIIAUWebServiceDatosUsuario";
//$params["key"] = "UdGSIIAUWebServiceEsAlumnoProfesor";
//$params["key"] = "UdGSIIAUWebServiceDescCarrera";

//$client  = new jcrdsoapclient('http://ms.mw.siiau.udg.mx/WSValidaUsuarios/ValidaUsuarios?WSDL');
$client  = new jcrdsoapclient('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
//$client  = new jcrdsoapclient('http://148.202.105.181/WebServiceLogon/WebServiceLogon?WSDL');

var_dump($client);
$respuesta = $client->call("datosUsuario", $params);
//$respuesta = $client->call("valida", $params);
//$respuesta = $client->call("esAlumnoProfesor", $params);
//$respuesta = $client->call("descCarrera", $params);
echo "-:"; echo $respuesta; echo ":-";
list($status, $codigo, $nombre, $var1, $var2) = explode(",", $respuesta);
echo ":";
echo $status; echo $codigo; echo $nombre; echo $var1; echo $var2;
echo ":";
?>
