<?php
	//script que conecta a la Base de Datos
	include('conectar.php');
	
	//calcula la fecha y hora
	$fecha = date("d/m/Y h:i:s");
	
	//divide la fecha por "/" y lo guarda en un arreglo 
	$d_m_yhi = explode('/',$fecha);
	
	//divide "año hora" por el espacio y lo guarda en un arreglo
	$y_hi = explode(' ',$d_m_yhi[2]);
	
	//revisa en que mes estamos y asigna el nombre del mes a la variable $mes
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
	
	//consulta que verifica que el ingreso se haga desde una ip permitida
	mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
	$ip_qry = "SELECT * FROM ip_permitidas WHERE ip = '$_SERVER[REMOTE_ADDR]'";
	$ip_res = mysql_query($ip_qry);
	$ip_row = mysql_fetch_array($ip_res);
	
	
	
	//variable que guarda desde donde se esta ingresando al sistema
	$cu = strtolower($ip_row['cu']);
	
	//nombre de la tabla donde se van a guardar los registros de ingreso
	$table_reg = strtolower($ip_row['cu'])."_registros";

	//codigo del visitante que ingresa
	$cod_ingreso=$_POST['codigo'];
	
	if($_POST['codigo'] == "000000001")
		$status = "x";	
	
	//consulta que se conecta a la tabla usuarios de la ibero
	//para verificar que exista el usuario, y obtener los datos que se insertarán
	mysql_select_db($bd2,$conn2) or die (mysql_error("Error al seleccionar la BD"));
	$sql="select * from usuariomayor WHERE id='$cod_ingreso' AND status_delete=0" ;
	$respuesta= mysql_query($sql);
	$numero= mysql_num_rows($respuesta); 
	
	if($numero=="0"){
		$sql="select * from usuariomenor WHERE id='$cod_ingreso' AND status_delete=0";
		$respuesta= mysql_query($sql);
		$numero= mysql_num_rows($respuesta); 
	}
	
	mysql_select_db($bd,$conn) or die (mysql_error("Error al seleccionar la BD"));
	
	if($cod_ingreso!='' AND strlen($cod_ingreso)==9 AND $numero>0)//si el usuario es de la ibero
	{
		$columna = mysql_fetch_array($respuesta);
		$status=$columna['status'];
		$codigo=$columna['id'];
		$carr_o_dep=$columna['carrera_ibe'];
		//guardamos el registro de ingreso
		$qry = "INSERT INTO $table_reg VALUES ('$status', '$codigo', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]', '$carr_o_dep')";	
		mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());
	}
	else// si el usuario es externo
	{
		if($cod_ingreso!='' AND strlen($cod_ingreso)==9)
		{
			 //usuario de la udg- conectar a service web siiau
			include('../web-service-SIIAU/cliente_SIB.php');
			if($CU == "CUVALLES")
					$CU = "VALLE";

			if($CU == "CUCI")
				$CU = "OCOTL";

			if($CU == "CUALTOS")
				$CU = "TEPA";

			if($CU == "SISTEMA DE UNIVERSIDAD VIRTUAL")
				$CU = "SUV";

			if($_SERVER['REMOTE_ADDR'] == "148.202.53.158")
				$CU = "CTA_LAGOS";
				
			if($CU == "AUTLA" && $_SERVER['REMOTE_ADDR'] == "148.202.214.3")
				$CU = "CUCSUR";
				
			if(($CU == "AUTLA" || $CU == "CUCSUR") && $_SERVER['REMOTE_ADDR'] == "148.202.213.166")
				$CU = "CAA_CUCSUR";
				
			$qry_compare = "SELECT * FROM $cu WHERE abrev = '$carr_o_dep'";

			if($_POST['codigo'] == "000000001")
				$status = "x";


			$res_compare = mysql_query($qry_compare);
			$row_compare = mysql_fetch_array($res_compare);

			if($status AND $status != "Array")
			{ 
				if(strtolower($cu) == strtolower($CU) OR strtolower("CU".$cu) == strtolower($CU))
				{
					if($row_compare)
					{
						$qry = "INSERT INTO $table_reg VALUES ('$status', '$codigo', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]', '$carr_o_dep')";				
						mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());
					}
					else
					{
						if($status != 'T')
						{
							$qry = "INSERT INTO $cu VALUES ('', 'Cambiar nombre', '$carr_o_dep')";
							mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());		
						}
						$qry = "INSERT INTO $table_reg VALUES ('$status', '$codigo', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]', '$carr_o_dep')";				
						mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());		
					}
				}
				else
				{
					$qry = "INSERT INTO ".$table_reg."_ext VALUES ('$status', '$codigo', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]', '$carr_o_dep', '$CU')";				
					mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());		
				}
				//print "<embed src=\"sonido/Right2b.mp3\" width=\"0%\" height=\"0%\">";

			}
			else
			{ 	if($_POST['x'])
				{
					//print "<embed src=\"sonido/Wrong2b.mp3\" width=\"0%\" height=\"0%\">";
				}
			}
			 
			 
			 
			 //guardamos el registro de ingreso
			if(strlen($cod_ingreso)==9 AND strcmp($cod_ingreso,"INVI1B3R0")==0){
				$qry = "INSERT INTO ".$table_reg."_ext VALUES ('I', 'INVI1B3R0', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]','$','EXTERNOS')";				
				mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());
			}
			else if(strlen($cod_ingreso)==9 AND strcmp($cod_ingreso,"INVM1B3R0")==0){
				$qry = "INSERT INTO ".$table_reg."_ext VALUES ('M', 'INVM1B3R0', '$d_m_yhi[0]', '$mes','$y_hi[0]', '$y_hi[1]','$','EXTERNOS_M')";				
				mysql_query($qry,$conn) or die ("Error en la Consulta: $qry. " . mysql_error());
			}

		}
	}
?>
<html> 
	<head>
		<title>ibero.SIB - Sistema de Ingreso a Bibliotecas</title>
		<script TYPE="text/javascript"> 
			<!-- 
			var downStrokeField; 
			
			//resalta el cuadro para poner el código
			function get_focus() 
			{
				 document.form1.codigo.focus();
			}  

			//manda el código ya que se escribió
			function autojump(fieldName,nextFieldName,fakeMaxLength)
			{ 
				 var myForm=document.forms[document.forms.length - 1]; 
				 var myField=myForm.elements[fieldName]; 
				 myField.nextField=myForm.elements[nextFieldName]; 
				 if (myField.maxLength == null) 
				 myField.maxLength=fakeMaxLength; 
				 myField.onkeydown=autojump_keyDown; 
				 myField.onkeyup=autojump_keyUp; 
			} 
		  
			function autojump_keyDown()
			{ 
				 this.beforeLength=this.value.length; 
				 downStrokeField=this; 
			} 
			
			function autojump_keyUp()
			{ 
				 if ( 
						  (this == downStrokeField) && 
						  (this.value.length > this.beforeLength) && 
						  (this.value.length >= this.maxLength) 
				 ) 
				 this.nextField.focus(); 
				 downStrokeField=null; 
			} 

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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

			.inputayuda{
				border: 1px solid #E3DDBD;
				background-color: #E3DDBD;
				color: #996633
			}

			.borde {
				border: 1px solid #333333;
			}

			.bordetd {
				border-bottom: 1px solid #333333;
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

			.toolsBarArea {background:#D3BF8A;border: 2px groove #F3EFE7;}

			.toolsBarOff {background:#D3BF8A;color:#000000;border: 2px outset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			.toolsBarOn {background:#D3BF8A;color:#000000;border: 2px inset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			.toolsBarOver {background:#D3BF8A;color:#000000;border: 2px inset #F3EFE7;font-weight: normal;font-size: 10px;text-align: center;padding: 1px 3px;font-family: arial,helvetica,sans-serif;}

			#textovertical {writing-mode: tb-rl; filter: flipv fliph}

			-->
		</style>
	</head> 
	<body onLoad="get_focus();"> 
		<?php 
			if(!$_GET['resolucion'])//obtiene la resolución de la pantalla
			{ 
		?>
				<script language="JavaScript1.2">
					<!--
					//document.writeln("<b>Tú resolución es de:</b> " + screen.width + " x " + screen.height +"");
					document.location.href="index.php?resolucion="+screen.width+"x"+screen.height;
					//-->
				</script>
		<?php 
			} 
		?>
		<?php echo "&nbsp;&nbsp;&nbsp;".$ip_row['cu']; ?>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" class="toolsBarArea">
			<tr>
				<td width="1%"></td>
				<td width="9%" class="toolsBarOff" id="1" title="Estadísticas" onClick="toolsBar(1,'toolsBarOver',2);Launch('#Estadísticas')" onMouseOver="toolsBar(1,'toolsBarOn',1)" onMouseOut="toolsBar(1,'toolsBarOff',0)"> <a href="estadisticas.php?resolucion=<?php echo $_GET['resolucion']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estadísticas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
				<td width="8%" class="toolsBarOff" id="3" title="Ayuda" onClick="toolsBar(3,'toolsBarOver',2);Launch('Ayuda')" onMouseOver="toolsBar(3,'toolsBarOn',1)" onMouseOut="toolsBar(3,'toolsBarOff',0)"> <a href="javascript:popUp('http://wdg.biblio.udg.mx/SIB/ayuda.php')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ayuda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
				<td width="71%">&nbsp;</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde">
			<tr>
				<td width="4" valign="top" class="bordetd">&nbsp;</td>
				<td width="175" valign="top" class="bordetd">
					<b><div class="texto2">Registro de Ingreso</div></b>
					<form action="index.php?resolucion=<?php echo $_GET['resolucion']; ?>"  name="form1" method='post' enctype="multipart/form-data"> 
						<span class="texto2">Codigo:</span>
						<input type='text' name="codigo" maxlength="9" SIZE="9" onChange="this.form.submit();">
						<input type='text' name="ayuda" maxlength="0" SIZE="1"  class="inputayuda" >
						<input type="hidden" name="x" value="1">
					</form>
					<script type="text/javascript"> 
						<!-- 
							autojump('codigo', 'ayuda', 9); 
						//--> 
					</script>
				</td>
				<td width="19" valign="top" class="bordetd">&nbsp;</td>
				<td width="767" valign="top" class="bordetd"> 
					<p class="texto2">Reporte Estad&iacute;stico<br>
						<?php
							echo "Estad&iacute;stica correspondiente al d&iacute;a $d_m_yhi[0] de $mes de $y_hi[0], a las $y_hi[1]<br><br>";
						?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<?php 
									$cu=strtolower($ip_row['cu']);
									$i=0;
									$qry = "SELECT * FROM $cu";
									$res = mysql_query($qry);
									$TOTAL=0;
									while($row = mysql_fetch_array($res))
									{
										$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status != 'E' AND (carrera = '$row[abrev]') AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
										$count_res = mysql_query($qry);
										$count_row = mysql_fetch_array($count_res);
										echo "<td><span class=\"texto2\">$row[abrev]=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
										$TOTAL = $TOTAL + $count_row['accesos'];
										$i++;
										if($i == 5)
										{
											echo "</tr>";
											$i=0;
										}
										$ultimo_reg_carr=$row['id'];
									}
									
									//personal UDG
									$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
									$count_res = mysql_query($qry);
									$count_row = mysql_fetch_array($count_res);
									$TOTAL = $TOTAL + $count_row['accesos'];
									echo "<td><span class=\"texto2\">Personal UdG=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";

									//egresados
									/*$qry = "SELECT COUNT(*) AS accesos FROM $table_reg WHERE status = 'E' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
									$count_res = mysql_query($qry);
									$count_row = mysql_fetch_array($count_res);
									$TOTAL = $TOTAL + $count_row['accesos'];
									echo "<td><span class=\"texto2\">egr=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";*/
									
									//otros centros universitarios
									$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status != 'I' AND status != 'M' AND status!='T' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
									$count_res = mysql_query($qry);
									$count_row = mysql_fetch_array($count_res);
									$TOTAL = $TOTAL + $count_row['accesos'];
									echo "<td><span class=\"texto2\">Otros CU=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";
									
									//externos
									$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'I' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
									$count_res = mysql_query($qry);
									$count_row = mysql_fetch_array($count_res);
									$TOTAL = $TOTAL + $count_row['accesos'];
									echo "<td><span class=\"texto2\">ext=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";

									//externos menores
									$qry = "SELECT COUNT(*) AS accesos FROM ".$table_reg."_ext WHERE status = 'M' AND dia = $d_m_yhi[0] AND mes = '$mes' AND year = $y_hi[0]";
									$count_res = mysql_query($qry);
									$count_row = mysql_fetch_array($count_res);
									$TOTAL = $TOTAL + $count_row['accesos'];
									echo "<td><span class=\"texto2\">ext_m=</span>&nbsp; <span class=\"texto1\">$count_row[accesos]</span>&nbsp;&nbsp;&nbsp;</td>";


											
									echo "<td><span class=\"texto2\"><b>TOTAL=<b/></span>&nbsp; <span class=\"texto1\">$TOTAL</span>&nbsp;&nbsp;&nbsp;</td>";
								?>
						</table>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center" valign="bottom" height="400">
					<?php include('grafica.php'); ?>	</td>
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