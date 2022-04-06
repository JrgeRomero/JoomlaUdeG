<?php 
include('conectar.php');

$sql = "SELECT carrera, COUNT(*) as cuenta FROM juliotst_registros WHERE año=2008 GROUP BY carrera";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res))
{
	echo $row{carrera}." ";
	echo $row{cuenta}."<br /> ";
}
?>