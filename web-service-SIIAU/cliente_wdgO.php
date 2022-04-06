<?php 
session_start(); 
require_once('lib/nusoap.php');
$params["usuario"] = $credentials['username'];
//$params["usuario"] = $_POST[username]; 
$params["password"] = $credentials['password'];
//$params["password"] = $_POST[passwd];
$params["key"] = "UdGSIIAUWebServiceValidaUsuario";
$client  = new jcrdsoapclient('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
//$client  = new jcrdsoapclient('http://148.202.105.181/WebServiceLogon/WebServiceLogon?WSDL');
if ($sError = $client ->getError()) {
   echo "No se pudo realizar la operación [" . $sError . "]";
   die();
} 
$respuesta = $client->call("valida", $params);
list($status, $codigo, $nombre, $var1, $var2) = explode(",", $respuesta);
if($status === "A")	$CU=$var1;
else $CU=$var2;
if($status === "A")	$carr_o_dep=$var2;
else $carr_o_dep=$var1;
/*echo $status."<br>";
echo $codigo."<br>";
echo $nombre."<br>";
echo $CU."<br>";
echo $carr_o_dep."<br>";*/
?>