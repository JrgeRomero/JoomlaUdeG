<?php
include('graphs.inc.php');
include('conectar.php');
$graph = new BAR_GRAPH('vBar');
$qry = "SELECT COUNT(*) AS cuenta FROM $cu";
$res = mysql_query($qry);
$row_h = mysql_fetch_array($res);

$qry = "SELECT * FROM $cu";
$res = mysql_query($qry);
$i = 1;
while($row = mysql_fetch_array($res))
{
	if($_POST['solo_hoy'])
	{ 
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $d_m_yhi[0] AND mes = '$mes' AND año = $y_hi[0]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $d_m_yhi[0] AND mes = '$mes' AND año = $y_hi[0]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $d_m_yhi[0] AND mes = '$mes' AND año = $y_hi[0]";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND año = $y_hi[0]";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND dia = $d_m_yhi[0] AND mes = '$mes' AND año = $y_hi[0]";
	}
	if($_POST['solo_mes'])
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$mes' AND año = $y_hi[0]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$mes' AND año = $y_hi[0]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$mes' AND año = $y_hi[0]";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND mes = '$mes' AND año = $y_hi[0]";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND mes = '$mes' AND año = $y_hi[0]";
	}
	if($_POST['solo_anio'])
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND año = $y_hi[0]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND año = $y_hi[0]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND año = $y_hi[0]";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND año = $y_hi[0]";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND año = $y_hi[0]";
	}
	if($_POST['all']) {
		if($_POST['mes'] === '0' AND $_POST['anio'])
		{
			$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND año = $_POST[anio]";
			$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND año = $_POST[anio]";
			$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND año = $_POST[anio]";
			$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND año = $_POST[anio]";
			$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND año = $_POST[anio]";
		}
		if($_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
		{
			$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $_POST[anio]";
		}
		if(!$_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
		{
			$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND mes = '$_POST[mes]' AND año = $_POST[anio]";
			$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND mes = '$_POST[mes]' AND año = $_POST[anio]";
		}
		if($_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
		{
			$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $y_hi[0]";			
			$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $y_hi[0]";			
			$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $y_hi[0]"; 	
			$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $y_hi[0]"; 	
			$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND año = $y_hi[0]"; 	
		}
		if(!$_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
		{
			$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_POST[mes]' AND año = $y_hi[0]";	
			$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_POST[mes]' AND año = $y_hi[0]";	
			$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_POST[mes]' AND año = $y_hi[0]";
			$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND mes = '$_POST[mes]' AND año = $y_hi[0]";
			$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND mes = '$_POST[mes]' AND año = $y_hi[0]";
		}
	}
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
		$graph->labels .= $row[abrev].",";
		$graph->values .= $count_row[accesos].",";
	$i++;
}

		$count_res = mysql_query($qry_pudg);
		$count_row = mysql_fetch_array($count_res);
$graph->labels .= "PUdG,";
$graph->values .= $count_row[accesos].",";

		$count_res = mysql_query($qry_egr);
		$count_row = mysql_fetch_array($count_res);
$graph->labels .= "egr,";
$graph->values .= $count_row[accesos].",";

		$count_res = mysql_query($qry_ocu);
		$count_row = mysql_fetch_array($count_res);
$graph->labels .= "OCU,";
$graph->values .= $count_row[accesos].",";

		$count_res = mysql_query($qry_ext);
		$count_row = mysql_fetch_array($count_res);
$graph->labels .= "ext";
$graph->values .= $count_row[accesos];

$res_explode= explode("x",$_GET['resolucion']);
$res=($res_explode[1])/($ultimo_reg_carr+2);
$graph->showValues = 1;
$graph->barWidth = $res;
$graph->labelSize = 10;
$graph->absValuesSize = 12;
$graph->percValuesSize = 12;
$graph->graphBGColor = '';
$graph->barColors = '#D3BF8A';
$graph->barBGColor = '';
$graph->labelColor = '#843031';
$graph->labelBGColor = '#D3BF8A';
$graph->absValuesColor = '#996633';
$graph->absValuesBGColor = '#FFFFFF';
$graph->graphPadding = 20;
$graph->graphBorder = '0px';
echo $graph->create();
?>
