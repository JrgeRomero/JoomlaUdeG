<?php
	include('conectar.php');
	mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
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

	$ip_qry = "SELECT * FROM ip_permitidas WHERE ip = '$_SERVER[REMOTE_ADDR]'";
	$ip_res = mysql_query($ip_qry);
	$ip_row = mysql_fetch_array($ip_res);

	$table_reg = strtolower($ip_row['cu'])."_registros";
	$cu=strtolower($ip_row['cu']);
?>
<html> 
	<head>
		<title>ibero.SIB - Sistema de Ingreso a Bibliotecas</title>
		<script TYPE="text/javascript"> 
			<!-- 
			var downStrokeField; 

			var pulsada=new Array();
			function toolsBar(id,classe,ev)
			{
			if (ev==0)
			{
			if(pulsada[0]!=id) document.getElementById(id).className=classe;
			}
			else if(ev==1)
			{
			if(pulsada[0]!=id) document.getElementById(id).className=classe;
			}
			else
			{
			if(pulsada[0]!=id&&pulsada!='') document.getElementById(pulsada[0]).className=pulsada[1];
			pulsada[0]=id;
			pulsada[1]='toolsBarOff';
			document.getElementById(id).className=classe;
			}
			}

			function popUp(URL) 
			{
				day = new Date();
				id = day.getTime();
				eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=450,height=250,left = 312,top = 284');");
			}

			  //--> 
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<style type="text/css">
			<!--
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				background-color: #E3DDBD;
				font-family:Arial, Helvetica, sans-serif;
				font-size: 10
			}
			.inputayuda{
				border: 1px solid #E3DDBD;
				background-color: #E3DDBD;
				color: #996633
			}

			.button { 
			  background       : #D3BF8A;
			  color:#843031;
			  font-family:Verdana, Arial, Helvetica, sans-serif;
			  font-size:10px;
			}

			.inputbox {
			  border           : 1px solid #6699cc;
			  background       : #FFFFFF;
			  color            : #666666;
			  font-family:Verdana, Arial, Helvetica, sans-serif;
			  font-size:10px;
			}

			table{
					font-size: 11px;
			}

			.texto1{
					color: #996633;
			}

			.texto2{
					color: #843031;
			}

			a:link, a:visited {
			  text-decoration  : none;
			  color            : #8F4501;
			}

			a:link#current, a:visited#current, a:hover {
			  text-decoration  : none;
			  color            : #990000;
			}

			a:hover {
			  text-decoration  : none;
			  color            : #990000;
			}

			.toolsBarArea {background:#D3BF8A;border: 2px groove #F3EFE7;}

			.toolsBarOff {background:#D3BF8A;color:#000000;border: 2px outset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			.toolsBarOn {background:#D3BF8A;color:#000000;border: 2px inset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			.toolsBarOver {background:#D3BF8A;color:#000000;border: 2px inset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			#textovertical {writing-mode: tb-rl; filter: flipv fliph}

			.borde {
				border: 1px solid #333333;
			}

			.bordev {
				border-left: 1px solid #333333;
			}

			.bordetd {
				border-top: 1px solid #333333;
			}

			-->
		</style>
	</head> 
	<body> 
		<?php 
			if(!$_GET['resolucion'])
			{ 
		?>
				<script language="JavaScript1.2">
					<!--
					document.writeln("<b>Tú resolución es de:</b> " + screen.width + " x " + screen.height +"");
					document.location.href="estadisticas.php?resolucion="+screen.width+"x"+screen.height;
					//-->
				</script>
		<?php 
			} 
		?>
		<?php 
			echo $ip_row['cu'];

			if($_POST['Submit'])
			{
				if($_POST['solo_hoy']) 
				{
					$fecha_est = "Estad&iacute;stica correspondiente al d&iacute;a $d_m_yhi[0] de $mes de $y_hi[0].<br><br>";
					$imp_fecha = "dia=$d_m_yhi[0]&mes=$mes&anio=$y_hi[0]";	
					echo $imp_fecha;
				}
				elseif($_POST['solo_mes']) 
				{
					$fecha_est = "Estad&iacute;stica correspondiente al mes de $mes de $y_hi[0].<br><br>";
					$imp_fecha = "mes=$mes&anio=$y_hi[0]";
				}
				elseif($_POST['solo_anio']) 
				{	
					$fecha_est = "Estad&iacute;stica correspondiente al Año $y_hi[0].<br><br>";
					$imp_fecha = "anio=$y_hi[0]";	
				}
				elseif($_POST['all'])
				{
					if($_POST['mes'] === '0' AND $_POST['anio'])
					{
						$fecha_est = "Estad&iacute;stica correspondiente al año $_POST[anio].<br><br>";
						$imp_fecha = "anio=$_POST[anio]";				
					}
					if($_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
					{
						$fecha_est = "Estad&iacute;stica correspondiente al d&iacute;a $_POST[dia] de $_POST[mes] de $_POST[anio].<br><br>";
						$imp_fecha = "dia=$_POST[dia]&mes=$_POST[mes]&anio=$_POST[anio]";	
					}
					if(!$_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
					{
						$fecha_est = "Estad&iacute;stica correspondiente al mes de $_POST[mes] de $_POST[anio].<br><br>";
						$imp_fecha = "mes=$_POST[mes]&anio=$_POST[anio]";
					}
					if($_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
					{
						$fecha_est = "Estad&iacute;stica correspondiente al d&iacute;a $_POST[dia] de $_POST[mes] de $y_hi[0].<br><br>";
						$imp_fecha = "dia=$_POST[dia]&mes=$_POST[mes]&anio=$y_hi[0]";
					}
					if(!$_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
					{
						$fecha_est = "Estad&iacute;stica correspondiente al mes de $_POST[mes] de $y_hi[0].<br><br>";
						$imp_fecha = "mes=$_POST[mes]&anio=$y_hi[0]";	
					}
				}
			}
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" class="toolsBarArea">
			<tr>
				<td width="1%"></td>
				<td width="9%" class="toolsBarOff" id="1" title="Estadísticas" onClick="toolsBar(1,'toolsBarOver',2);Launch('#Estadísticas')" onMouseOver="toolsBar(1,'toolsBarOn',1)" onMouseOut="toolsBar(1,'toolsBarOff',0)"> 
					<a href="index.php?resolucion=<?php echo $_GET['resolucion']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
				</td>
				<?php
					if($_POST['Submit'])
					{
				?>
						<td width="9%" class="toolsBarOff" id="2" title="Imprimir" onClick="toolsBar(2,'toolsBarOver',2);Launch('#Imprimir')" onMouseOver="toolsBar(2,'toolsBarOn',1)" onMouseOut="toolsBar(2,'toolsBarOff',0)">
							<a href="pdf.php?<?php echo $imp_fecha; ?>" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						</td>
				<?php
					}
				?>
				<td width="8%" class="toolsBarOff" id="3" title="Ayuda" onClick="toolsBar(3,'toolsBarOver',2);Launch('Ayuda')" onMouseOver="toolsBar(3,'toolsBarOn',1)" onMouseOut="toolsBar(3,'toolsBarOff',0)"> 
					<a href="javascript:popUp('http://wdg.biblio.udg.mx/SIB/ayuda.php')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ayuda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
				</td>
				<td width="71%"></td>		
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde">
			<tr>
				<td width="15">&nbsp;</td>
				<td width="179" valign="top">
					<b><div class="texto2">Obtener reporte por:</div></b>
				</td>
				<td width="19" rowspan="9" valign="top" class="bordev">&nbsp;</td>
				<td width="769" rowspan="9" valign="top">
					<p class="texto2">
						<?php 
							if($_POST['Submit'])
							{ 
								echo "Reporte Estad&iacute;stico"; 
						?>
								<br>
								<?php
									echo $fecha_est;
								?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<?php 
										$cu=strtolower($ip_row['cu']);
										$i=0;
										$qry = "SELECT * FROM $cu";
										$res = mysql_query($qry);
										$TOTAL = 0;
										while($row = mysql_fetch_array($res))
										{
											if($_POST['solo_hoy'])
											{ 
												$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";				
												$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
												$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";

											}
											if($_POST['solo_mes'])
											{
												$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$mes' AND year = $y_hi[0]";
												$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND mes = '$mes' AND year = $y_hi[0]";
												$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND mes = '$mes' AND year = $y_hi[0]";
												$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND mes = '$mes' AND year = $y_hi[0]";

											}
											if($_POST['solo_anio'])
											{
												$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND year = $y_hi[0]";
												$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND year = $y_hi[0]";
												$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND year = $y_hi[0]";
												$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND year = $y_hi[0]";
												$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND year = $y_hi[0]";
												$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND year = $y_hi[0]";
											}
											if($_POST['all']) {
												if($_POST['mes'] === '0' AND $_POST['anio'])
												{
													$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND year = $_POST[anio]";
													$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND year = $_POST[anio]";
													$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND year = $_POST[anio]";
													$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND year = $_POST[anio]";
													$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND year = $_POST[anio]";
													$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND year = $_POST[anio]";
												}
												if($_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
												{
													$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $_POST[anio]";

												}
												if(!$_POST['dia'] AND $_POST['mes'] AND $_POST['anio'])
												{
													$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND mes = '$_POST[mes]' AND year = $_POST[anio]";
													$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND mes = '$_POST[mes]' AND year = $_POST[anio]";

												}
												if($_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
												{
													$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]";			
													$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]";			
													$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status!='T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]"; 	
													$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]"; 	
													$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]"; 	
													$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND dia = $_POST[dia] AND mes = '$_POST[mes]' AND year = $y_hi[0]"; 	
												}
												if(!$_POST['dia'] AND $_POST['mes'] AND !$_POST['anio'])
												{
													$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND carrera = '$row[abrev]' AND mes = '$_POST[mes]' AND year = $y_hi[0]";	
													$qry_egr = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND mes = '$_POST[mes]' AND year = $y_hi[0]";	
													$qry_ocu = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status !='M' AND status != 'T' AND mes = '$_POST[mes]' AND year = $y_hi[0]";
													$qry_pudg = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND mes = '$_POST[mes]' AND year = $y_hi[0]";
													$qry_ext = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND mes = '$_POST[mes]' AND year = $y_hi[0]";
													$qry_ext_m = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND mes = '$_POST[mes]' AND year = $y_hi[0]";
												}
											}
											$count_res = mysql_query($qry);
											$count_row = mysql_fetch_array($count_res);
											$TOTAL = $TOTAL + $count_row["accesos"];
											echo "<td><span class=\"texto2\">$row[abrev]=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
											$i++;
											if($i == 5)
											{
												echo "</tr>";
												$i=0;
											}
											$ultimo_reg_carr=$row["id"];
										} 
		
										/*$count_res = mysql_query($qry_egr);
										$count_row = mysql_fetch_array($count_res);
										$TOTAL = $TOTAL + $count_row["accesos"];
										echo "<td><span class=\"texto2\">egr=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";*/

										$count_res = mysql_query($qry_pudg);
										$count_row = mysql_fetch_array($count_res);
										$TOTAL = $TOTAL + $count_row["accesos"];
										echo "<td><span class=\"texto2\">Personal UdG=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";

										$count_res = mysql_query($qry_ocu);
										$count_row = mysql_fetch_array($count_res);
										$TOTAL = $TOTAL + $count_row["accesos"];
										echo "<td><span class=\"texto2\">Otro CU=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";

										$count_res = mysql_query($qry_ext);
										$count_row = mysql_fetch_array($count_res);
										$TOTAL = $TOTAL + $count_row["accesos"];
										echo "<td><span class=\"texto2\">ext=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";

										$count_res = mysql_query($qry_ext_m);
										$count_row = mysql_fetch_array($count_res);
										$TOTAL = $TOTAL + $count_row["accesos"];
										echo "<td><span class=\"texto2\">ext_m=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";


									?>
			</tr>
							</table>
							<br />
							<b><span class=\"texto2\">TOTAL=</span>&nbsp; <span class=\"texto1\"><?php echo "$TOTAL"; ?></span></b>
							<br />
					  </p>
					  <?php } ?>
				</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td valign="top"><p><form action="estadisticas.php?resolucion=<?php echo $_GET['resolucion']; ?>" name="hoy" method="post" enctype="multipart/form-data">
      <input name="solo_hoy" type="hidden" value="<?php echo $d_m_yhi[0]; ?>">
      <input name="Submit" type="submit" class="button" value="HOY">
    </form></p></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top"><p><form action="estadisticas.php?resolucion=<?php echo $_GET['resolucion']; ?>" name="mes" method="post" enctype="multipart/form-data">
      <input name="solo_mes" type="hidden" value="<?php echo $mes; ?>">
      <input name="Submit" class="button" type="submit" value="MES">
    </form></p></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top"><p><form action="estadisticas.php?resolucion=<?php echo $_GET['resolucion']; ?>" name="anio" method="post" enctype="multipart/form-data">
      <input name="solo_anio" type="hidden" value="<?php echo $d_m_yhi[0]; ?>">
      <input name="Submit" class="button" type="submit" value="A&Ntilde;O">
    </form></p></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top"><b><div class="texto2">O específica la Fecha:</div></b></td>
  </tr>
  <form action="estadisticas.php?resolucion=<?php echo $_GET['resolucion']; ?>" name="fecha_all" method="post" enctype="multipart/form-data">
  <tr>
  	<td>&nbsp;</td>
    <td valign="top">Dia:&nbsp;&nbsp;
      <input name="dia" type="text" size="2" maxlength="2"></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td valign="top">Mes:
      <select name="mes">
		<option value="0">Elige mes</option>  
        <option value="Enero">Enero</option>
        <option value="Febrero">Febrero</option>
        <option value="Marzo">Marzo</option>
        <option value="Abril">Abril</option>
        <option value="Mayo">Mayo</option>
        <option value="Junio">Junio</option>
        <option value="Julio">Julio</option>
        <option value="Agosto">Agosto</option>
        <option value="Septiembre">Septiembre</option>
        <option value="Octubre">Octubre</option>
        <option value="Noviembre">Noviembre</option>
        <option value="Diciembre">Diciembre</option>
      </select></td>
  </tr>
    <tr>
  	<td>&nbsp;</td>
    <td valign="top">A&ntilde;o:
    <input name="anio" type="text" size="4" maxlength="4"><input name="all" type="hidden" value="all">
    </td>
  	<td class="bordev">&nbsp;</td>
  	<td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" align="left"><input name="Submit" class="button" type="submit" value="Generar Estadística">
	 <td valign="top" class="bordev">&nbsp;</td><td valign="top" >&nbsp;</td>
      <br></td>
  </tr>
  </form>
  <tr>
  	<td class="bordetd">&nbsp;</td>
    <td colspan="3" align="center" valign="bottom" height="400" class="bordetd"><br>
		<?php if($_POST['Submit']){ ?>
		<?php include('grafica_estadisticas.php'); ?>	
		<?php } ?>
	</td>
  </tr>
</table>
		<p align="center">
			&copy; <a href="http://www.udg.mx" target="_blank">Universidad de Guadalajara.</a> 
			<a href="http://www.cga.udg.mx" target="_blank">Coordinaci&oacute;n General Acad&eacute;mica.</a> 
			<a href="http://www.rebiudg.udg.mx" target="_blank">Coordinaci&oacute;n de Bibliotecas.</a> <strong>2006.</strong><br/>
			<a href="mailto:bibliotecadigital@redudg.udg.mx">bibliotecadigital@redudg.udg.mx</a> 
		</p>
	</body> 
</html> 