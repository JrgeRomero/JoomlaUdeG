<!--		VALIDACIÓN DE ACCESO		-->

<?php
//define('_JEXEC', 1);
if (file_exists(__DIR__ . '/defines.php'))
{
	include_once __DIR__ . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	//define('JPATH_BASE', __DIR__);
	require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_BASE . '/includes/framework.php';

//Funcion para validar que una cadena termine con determinados caracteres
function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

// Validación para no poder acceder a la página: paginaacceso cuando un usuario este ya logeado
$uri = $_SERVER['REQUEST_URI'];
if(endsWith($uri,"paginaacceso") == true && JFactory::getUser()->id != 0){
	header('Location: index.php');
}

// *** CREAR VARIABLES DE SESION (PRUEBA)
//$mainframe = JFactory::getApplication('site');
//$mainframe->initialise();
$session = JFactory::getSession();
//echo $session->get('CODE');
//echo $session->get('CU');
//echo ",".$session->get('CARR');
?>

<!--		FIN VALIDACIÓN DE ACCESO		-->

<!--            Agregar Favicon         -->
	<link rel="shortcut icon" href="./templates/rt_chapelco/favicon.ico"/>

	<!-- Agregar directorio Dinámico -->
	<!--<div class="maxdir">
		<div>
			<a class="directoriod" href="index.php/directorio">.</a>
		</div>
	</div>-->
	
	<!--		HEADER DINAMICO		-->
	<link rel="stylesheet" href="/headerdinamico/estiloheaderdinamico.css">
	<script src="/headerdinamico/jquery1-11-1.js"></script>
	<script src="/headerdinamico/headerdinscript.js"></script>
	<headerD onClick="expandirHeaderDinamico()">
	<div class="headerdintop">
	</div>
	<div class="wrapper">
		<div class="logo">
			<a href="index.php" title="Ir a la p&aacute;gina principal"><img src="/headerdinamico/wdgbibliobco.png" height="50%" width="50%"></a>
			<a href="http://www.udg.mx/" target="_blank" title="Ir a la p&aacute;gina de la Universidad de Guadalajara"><img src="/headerdinamico/UdeG.png" height="30%" width="30%"></a>
		</div>
		<nav>
			<a href="index.php" class="tituloshd hdprincipal">Principal</a>
			<a href="index.php/bases-de-datos" class="tituloshd hdrecursosinformativos">Recursos informativos</a>
			<?php				
				//El if muestra un menu Repositorio Institucional para Usuarios no Loggeados, el else un menu Repositorio Institucional para Usuarios Loggeados
				if (JFactory::getUser()->id == 0){
				    echo "<a href=\"index.php/repo-inv\" class=\"tituloshd hdrepo\">Repositorio Institucional</a>";
				}
				else{
				    echo "<a href=\"https://www.riudg.udg.mx/\" target=\"_blank\" class=\"tituloshd hdrepo\">Repositorio Institucional</a>";
				}
			?>
			<a href="index.php/catalogos-linea" class="tituloshd hdcatalogosl">Cat&aacute;logos en l&iacute;nea</a>
			<a href="index.php/herramientas" class="tituloshd hdherramientas">Herramientas</a>
			<a href="index.php/ser-bib" class="tituloshd hdserviciosb">Servicios bibliotecarios</a>
		</nav>
	</div>
	</headerD>
	<!--		FIN HEADER DINAMICO	-->

	<!--		PUBLICIDAD		-->
	<?php //include "anuncios/index.html"; ?>
	<!--		FIN PUBLICIDAD		-->

	<!--		MENU UDG       		-->

	 <!-- Carga de la barra de accesos de la UdeG mas actual-->
        <!--<link rel="shortcut icon" href="http://www.udg.mx/sites/default/files/favicon.ico" type="http://www.udg.mx/image/vnd.microsoft.icon">-->
	<link rel="shortcut icon" href="../../menu_udg/menu_udgNEW/favicon.ico">
        <script type="text/javascript" src="../../menu_udg/menu_udgNEW/udg-menu.js"></script>
      	<script type="text/javascript">
		var UDGMenuWidth ='100%';
		document.writeln( crearTag( 'div', 'id="udg_menu_principal"' ) ); setTimeout( 'UDGMenu()', 100 );
	</script>
	<link rel='stylesheet' type='text/css' href='/menu_udg/udg-menu.css'>
	<!-- Fin de la carga de la barra de accesos de la UdeG -->

	<!--		FIN MENU UDG   		-->
