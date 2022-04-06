<html>
	<header>
		<meta charset="UTF-8">
		<title>Escribir sobre imágenes</title>
		<link rel="stylesheet" href="estiloimpresion.css">
	</header>
		<body>
			<img id='credencialfondo' src="frentecredencial.jpg" >
			<img id='foto' src="fotoprueba.jpg" width="100" height="120"> <!-- Las imagenes que cubren el fondo de las credenciales deben tener un tamaño de 1438 x 1049 pixeles para que tengan el tamaño exacto de una hoja tamaño carta-->
			<p id="nombre" align="center"><font face="calibri" size=3 color="white">Marquez Pinto Juan Manuel</font></a><br>
			<img  id="vueltacredencial" src="vueltacredencial.jpg" >
			<img id="codigobarras" src="barcodegen.1d-php5.v2.2.0/test128.php?text=IBE000001" alt="barcode" />
			
			<br><br><br><br><br>
			<div align="center" >
				<p><font face="calibri" size=4> Asegúrese; antes de imprimir, colocar en las configuraciónes de la ventana de impresión la hoja en orientación horizontal y sin márgenes.</font></p>
				
				<SCRIPT LANGUAGE="JavaScript"> 
				if (window.print) {
					document.write('<form><input type=button name=print value="Imprimir" onClick="window.print()"></form>');
				}
				</script>
			</div>
		</body>
	<footer>
		
	</footer>
</html>