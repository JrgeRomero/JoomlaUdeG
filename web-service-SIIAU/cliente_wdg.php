<?php 
	//session_start(); 
	require_once('lib/nusoap.php');
	//$params["usuario"] = $_POST['username']; 
	$params["usuario"] = $credentials['username'];  
	//$params["password"] = $_POST['passwd'];
	$params["password"] = $credentials['password'];
	$params["key"] = "UdGSIIAUWebServiceValidaUsuario";
	//$params["key"] = "UdGSIIAUWebServiceDatosUsuario";
	//$client  = new jcrdsoapclient('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
	$client  = new wdgsiiauNEW_client('http://148.202.105.71/WebServiceLogon/WebServiceLogon?WSDL');
	//$client  = new jcrdsoapclient('http://148.202.105.181/WebServiceLogon/WebServiceLogon?WSDL');

	// pra conectarse a mysql en vieja wdg
	/*$host = "localhost";
	$db = "acceso_wdg";
	$usr = "root"; 
	$pwd = "wdgdigital06";*/

	//para conectarse a mysql en nueva wdg
	$host = "localhost";
	$db = "acceso_wdg";
	$usr = "root"; 
	$pwd = "lMz17-48";
	$primernombre = "";


	// revisa en siiau
	if ($sError = $client ->getError()) {
	   echo "No se pudo realizar la operacion [" . $sError . "]";
	   die();
	} 
	
	$respuesta = $client->call("valida", $params);

	//Validar un usuario SIIAU de recien ingreso
	/*if($respuesta == "0" OR $respuesta == ''){
			//$params2["usuario"] = $_POST[username];
			$params2["usuario"] = $user->username;
			$params2["key"] = "UdGSIIAUWebServiceDatosUsuario";
			$client2  = new jcrdsoapclient('http://iasv2.siiau.udg.mx/WebServiceLogon/WebServiceLogon?WSDL');
			if ($sError = $client2 ->getError()) {
			   echo "No se pudo realizar la operaciσn [" . $sError . "]";
			   die();
			} 
			$respuesta = $client2->call("datosUsuario", $params2);
	}*/

	list($status, $codigo, $nombre, $var1, $var2) = explode(",", $respuesta);
	if($status === "A" OR $status === "E")	$CU=$var1;
	else $CU=$var2;
	if($status === "A" OR $status === "E")	$carr_o_dep=$var2;
	else $carr_o_dep=$var1;

	//calcula fecha 
	$ahora=time();
	$fecha= date('Y-m-d', $ahora);
	$hora= date('H:i:s.u', $ahora);

	//PRUEBA DE VARIABLE DE SESION CON EL CODIGO
	//$_SESSION['username'] = $nombre;

	//funcion eliminar acentos
	function stripAccents($string){
		return strtr($string,'ΰαβγδηθικλμνξορςστυφωϊϋόύÿΐΑΒΓΔΗΘΙΚΛΜΝΞΟΡÒΣΤΥΦΩΪΫάέ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}
	
	$nombre = stripAccents($nombre);
	$CU = stripAccents($CU);
	$carr_o_dep = stripAccents($carr_o_dep);

	//conexion a mysql (25 Feb 09)
	if($status === "A" OR $status === "E" OR $status === "T")	
	{  //se validσ 26 Feb 09 para que grabe solo usrs siiau
		/*$cid= mysql_connect($host,$usr,$pwd)or die (mysql_error("Error al conectar a la BD"));
		mysql_select_db($db, $cid);
		$query="INSERT INTO accesaron VALUES ('','1','".$status."', '".$codigo."', '".$nombre."', '".$CU."', '".$carr_o_dep."', '".$fecha."','".$hora."')";
		$result= mysql_query($query);
	
		mysql_close($cid); //cierra la conexion*/

		$partesnombre = explode(" ", $nombre);
		$primernombre = $partesnombre[0];
	} 
?>