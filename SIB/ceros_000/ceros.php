<?php 
include('../conectar.php');
$qry = "SELECT * FROM alumnos";
$res = mysql_query($qry);
while($row = mysql_fetch_array($res))
{
	// $cad="12345";
	if(strlen($row['codigo']) < 9)
	{
		$rev = strrev($row['codigo']);
		while(strlen($rev) < 9)
		{
			$rev = $rev."0";
		}
		$rev = strrev($rev);
		//$codigo = $row['codigo'];
		$qup = "UPDATE alumnos SET codigo = '$rev' WHERE id = '$row[id]'";
		//echo $qup; 
		mysql_query($qup);

	}
}
?>