<?php
include('conectar.php');
require('FPDF/fpdf.php');
$fecha = date("d/m/Y h:i:s");
$d_m_yhi = explode('/',$fecha);
$y_hi = explode(' ',$d_m_yhi[2]);
switch($d_m_yhi[1])
{
	case 1:	$mes = "Enero"; break;
	case 2:	$mes = "Febrero"; break;
	case 3:	$mes = "Marzo"; break;
	case 4:	$mes = "Abril"; break;
	case 5:	$mes = "Mayo"; break;
	case 6:	$mes = "Junio"; break;
	case 7:	$mes = "Julio"; break;
	case 8:	$mes = "Agosto"; break;
	case 9:	$mes = "Septiembre"; break;
	case 10: $mes = "Octubre"; break;
	case 11: $mes = "Noviembre"; break;
	case 12: $mes = "Diciembre"; break;
}

$ip_qry = "SELECT * FROM ip_cu WHERE ip = '$_SERVER[REMOTE_ADDR]'";
$ip_res = mysql_query($ip_qry);
$ip_row = mysql_fetch_array($ip_res);

$table_reg = strtolower($ip_row['cu'])."_registros";
$cu=strtolower($ip_row['cu']);

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);


//echo "Reporte Estad&iacute;stico"; 

if(($_GET['mes'] === '0' AND $_GET['anio']) OR (!$_GET['dia'] AND !$_GET['mes'] AND $_GET['anio']))
	$pdf->Cell(40,10,"Estadística correspondiente al año $_GET[anio].");
	//echo "Estad&iacute;stica correspondiente al año $_GET[anio].<br><br>";				
if($_GET['dia'] AND $_GET['mes'] AND $_GET['anio'])
	$pdf->Cell(40,10,"Estadística correspondiente al día $_GET[dia] de $_GET[mes] de $_GET[anio].");
	//echo "Estad&iacute;stica correspondiente al d&iacute;a $_GET[dia] de $_GET[mes] de $_GET[anio].<br><br>";
if(!$_GET['dia'] AND $_GET['mes'] AND $_GET['anio'])
	$pdf->Cell(40,10,"Estadística correspondiente al mes de $_GET[mes] de $_GET[anio].<br><br>");
	//echo "Estad&iacute;stica correspondiente al mes de $_GET[mes] de $_GET[anio].<br><br>";
if($_GET['dia'] AND $_GET['mes'] AND !$_GET['anio'])
	$pdf->Cell(40,10,"Estadística correspondiente al día $_GET[dia] de $_GET[mes] de $y_hi[0].");
	//echo "Estad&iacute;stica correspondiente al d&iacute;a $_GET[dia] de $_GET[mes] de $y_hi[0].<br><br>";
if(!$_GET['dia'] AND $_GET['mes'] AND !$_GET['anio'])
	$pdf->Cell(40,10,"Estadística correspondiente al mes de $_GET[mes] de $y_hi[0].");
	//echo "Estad&iacute;stica correspondiente al mes de $_GET[mes] de $y_hi[0].<br><br>";

$pdf->Ln(); $pdf->Ln();
$cu = strtolower($ip_row['cu']);
$i = 0;
$qry = "SELECT * FROM $cu";
$res = mysql_query($qry);
$TOTAL = 0;
while($row = mysql_fetch_array($res))
{
	if(($_GET['mes'] === '0' AND $_GET['anio']) OR (!$_GET['dia'] AND !$_GET['mes'] AND $_GET['anio']))
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND año = $_GET[anio]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND año = $_GET[anio]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND año = $_GET[anio]";
		$qry_dcu_ocu = "SELECT CU, COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND año = $_GET[anio] GROUP BY CU";
		$qry_dca_ocu2 = "' AND status != 'x' AND año = $_GET[anio] GROUP BY carrera";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND año = $_GET[anio]";
		$qry_dpudg = "SELECT COUNT(*) AS accesos, carrera FROM $table_reg WHERE status = 'T' AND año = $_GET[anio] GROUP by carrera";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND año = $_GET[anio]";
	}
	if($_GET['dia'] AND $_GET['mes'] AND $_GET['anio'])
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_dcu_ocu = "SELECT CU, COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP BY CU";
		$qry_dca_ocu2 = "' AND status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP BY carrera";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_dpudg = "SELECT COUNT(*) AS accesos, carrera FROM $table_reg WHERE status = 'T' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP by carrera";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $_GET[anio]";
	}
	if(!$_GET['dia'] AND $_GET['mes'] AND $_GET['anio']) ///////////////////////////////////////////////
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND mes = '$_GET[mes]' AND año = $_GET[anio]";
		$qry_dpudg = "SELECT COUNT(*) AS accesos, carrera FROM $table_reg WHERE status = 'T' AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP by carrera";
		$qry_dcu_ocu = "SELECT CU, COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP BY CU";
		$qry_dca_ocu2 = "' AND status != 'x' AND mes = '$_GET[mes]' AND año = $_GET[anio] GROUP BY carrera";

		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND mes = '$_GET[mes]' AND año = $_GET[anio]";
	}
	if($_GET['dia'] AND $_GET['mes'] AND !$_GET['anio'])
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0]";			
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0]";			
		$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0]"; 	
		$qry_dcu_ocu = "SELECT CU, COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP BY CU"; 	
		$qry_dca_ocu2 = "' AND status != 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP BY carrera"; 	
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0]"; 	
		$qry_dpudg = "SELECT COUNT(*) AS accesos, carrera FROM $table_reg WHERE status = 'T' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP by carrera"; 	
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND dia = $_GET[dia] AND mes = '$_GET[mes]' AND año = $y_hi[0]"; 	
	}
	if(!$_GET['dia'] AND $_GET['mes'] AND !$_GET['anio'])
	{
		$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_GET[mes]' AND año = $y_hi[0]";	
		$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_GET[mes]' AND año = $y_hi[0]";	
		$qry_ocu = "SELECT  COUNT(*) FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_GET[mes]' AND año = $y_hi[0]";
		$qry_dcu_ocu = "SELECT CU, COUNT(*) FROM ".$table_reg."_ext WHERE status != 'x' AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP BY CU";
		$qry_dca_ocu2 = "' AND status != 'x' AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP BY carrera";
		$qry_pudg = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'T' AND mes = '$_GET[mes]' AND año = $y_hi[0]";
		$qry_dpudg = "SELECT COUNT(*) AS accesos, carrera FROM $table_reg WHERE status = 'T' AND mes = '$_GET[mes]' AND año = $y_hi[0] GROUP by carrera";
		$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'x' AND mes = '$_GET[mes]' AND año = $y_hi[0]";
	}
		
	$count_res = mysql_query($qry);
	$count_row = mysql_fetch_array($count_res);
	$TOTAL = $TOTAL + $count_row["accesos"];
	$pdf->Cell(40,10,"$row[abrev]  =  $count_row[accesos]");
    //echo "<td><span class=\"texto2\">$row[abrev]=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
	$i++;
	if($i == 5)
	{
		$pdf->Ln();
		$i=0;
	}
	$ultimo_reg_carr=$row[id];
} 
$pdf->Ln(); $pdf->Ln();

$count_res = mysql_query($qry_pudg);
$count_row = mysql_fetch_array($count_res);
$TOTAL = $TOTAL + $count_row["accesos"];
$pdf->Cell(40,10,"Personal del Centro Universitario =  $count_row[accesos]");
//echo "<td><span class=\"texto2\">Personal del Ce=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
$pdf->Ln();

$count_res = mysql_query($qry_egr);
$count_row = mysql_fetch_array($count_res);
$TOTAL = $TOTAL + $count_row["accesos"];
$pdf->Cell(40,10,"Egresados  =  $count_row[accesos]");
//echo "<td><span class=\"texto2\">egr=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
$pdf->Ln();

$count_res = mysql_query($qry_ocu);
$count_row = mysql_fetch_array($count_res);
$TOTAL = $TOTAL + $count_row["accesos"];
$pdf->Cell(40,10,"Visitas de Otros Centros Universitarios  =  $count_row[accesos]");
//echo "<td><span class=\"texto2\">Otro CU=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
$pdf->Ln();

$count_res = mysql_query($qry_ext);
$count_row = mysql_fetch_array($count_res);
$TOTAL = $TOTAL + $count_row["accesos"];
$pdf->Cell(40,10,"Externos a UdG  =  $count_row[accesos]");
//echo "<td><span class=\"texto2\">ext=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
$pdf->Ln();

$pdf->Ln();
$pdf->Cell(40,10,"TOTAL  =  $TOTAL");
//echo "<td><span class=\"texto2\">TOTAL=</span>&nbsp; <span class=\"texto1\">$TOTAL</span>&nbsp;&nbsp;&nbsp;</td>";
$pdf->AddPage();


$pdf->Cell(40,10,"Detalles de visitas de profesores y administrativos de $cu");
$pdf->Ln(); 
//echo "<br><br><br>Detalles de Profesores y administrativos de $cu<br>";
$count_res = mysql_query($qry_dpudg);
while($count_row = mysql_fetch_array($count_res))
{
	$pdf->Cell(40,10,"$count_row[carrera] = $count_row[accesos]");
	$pdf->Ln();
	//echo $count_row[carrera]." = ".$count_row[accesos]."<br>";
}


$pdf->Ln(); $pdf->Ln();
$pdf->Cell(40,10,"Detalles de visitas de usuarios de otros Centros Universitarios");
//echo "<br><br><br>Detalles de Usuarios de Otros CUs<br>";
$qry_dca_ocu1 = "SELECT carrera, COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE CU = '";
$count_res = mysql_query($qry_dcu_ocu);
while($count_row = mysql_fetch_array($count_res))
{
	$pdf->Ln();
	$pdf->Cell(40,10,"Centro o coordinación: $count_row[CU] = $count_row[accesos]");
	$pdf->Ln();
	//echo "<br>Total en ".$count_row[CU]." = ".$count_row[accesos]."<br>";
	$fqry = $qry_dca_ocu1;
	$fqry .= $count_row[CU];
	$fqry .= $qry_dca_ocu2;		
	$count_resx = mysql_query($fqry);
	while($count_rowx = mysql_fetch_array($count_resx))
	{
		$pdf->Cell(40,10,"$count_rowx[carrera] = $count_rowx[accesos]");
		$pdf->Ln();
	}
	//echo $count_rowx[carrera]." = ".$count_rowx[accesos]."<br>";
}

$pdf->Output();
?>