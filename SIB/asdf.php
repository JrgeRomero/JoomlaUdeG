<?php

include('conectar.php');

$qry = "SELECT * FROM sjuan_registros_ext WHERE CU='SJUAN'";
$res = mysql_query($qry);
while($row = mysql_fetch_array($res))
{
	 		$qry_ins = "INSERT INTO sjuan_registros VALUES ('$row[status]', '$row[codigo]', '$row[dia]', '$row[mes]','$row[año]', '$row[hora]', '$row[carrera]')";				
			mysql_query($qry_ins) or die ("Error en la Consulta: $qry. " . mysql_error());

}

?>