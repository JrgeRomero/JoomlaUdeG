<?php
	include('graphs.inc.php');//archivo con la clase para crear la gráfica
	include('conectar.php');//archivo que conecta a la base de datos
	//mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
	$graph = new BAR_GRAPH('vBar');

	$qry = "SELECT * FROM $cu";
	$res = mysql_query($qry);
	$i = 1;
	while($row = mysql_fetch_array($res))
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
		$count_res = mysql_query($qry);
		$count_row = mysql_fetch_array($count_res);
		$graph->labels .= $row['abrev'].",";
		$graph->values .= $count_row['accesos'].",";
		$i++;
	}

	$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$graph->labels .= "PUdG,";
	$graph->values .= $count_row['accesos'].",";

	/*$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$graph->labels .= "egr,";
	$graph->values .= $count_row['accesos'].",";*/


	$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$graph->labels .= "OCU,";
	$graph->values .= $count_row['accesos'].",";

	$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$graph->labels .= "EXTERNOS,";
	$graph->values .= $count_row['accesos'].",";

	$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$graph->labels .= "EXTERNOS_M";
	$graph->values .= $count_row['accesos'];

	$res_explode= explode("x",$_GET['resolucion']);
	$res=($res_explode[1])/($ultimo_reg_carr+2);
	$graph->showValues = 1;
	$graph->barWidth = $res;
	if($i >=30) $graph->labelSize = 8;
	else $graph->labelSize = 10;
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
