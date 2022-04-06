<?php 
require_once('lib/nusoap.php');
//$params["usuario"] = $credentials['username'];
$params["usuario"] = $_POST['codigo']; 
// $params["usuario"] = "399329068"; 
$params["key"] = "UdGSIIAUWebServiceDatosUsuario";
$client  = new jcrdsoapclient('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
//$client  = new jcrdsoapclient('http://148.202.105.181/WebServiceLogon/WebServiceLogon?WSDL');
// $client  = new jcrdsoapclient('http://148.202.105.206/WebServiceLogon/WebServiceLogon?WSDL');
if ($sError = $client ->getError()) {
   echo "No se pudo realizar la operación [" . $sError . "]";
   die();
} 
$respuesta = $client->call("datosUsuario", $params);
list($status, $codigo, $nombre, $var1, $var2) = explode(",", $respuesta);
if($status === "A" OR $status === "E")	$CU=$var1;
else $CU=$var2;
if($status === "A" OR $status === "E")	$carr_o_dep=$var2;
else $carr_o_dep=$var1;
/*
echo $status."<br>";
echo $codigo."<br>";
echo $nombre."<br>";
echo $CU."<br>";
echo $carr_o_dep."<br>";
*/
?>