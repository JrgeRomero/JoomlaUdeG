<!--*******************************  AGREGAR MENU MOVIL ****************************************-->
<menuMovilJM>
	<div class="wrappermobile">
	<nav>
		<a href="index.php" class="tituloshd hdprincipal">Principal</a>
		<a href="index.php/bases-de-datos" class="tituloshd hdrecursosinformativos">Recursos Informativos</a>
		<?php
		//El if muestra un menu Repositorio Institucional para Usuarios no Loggeados, el else un menu Repositorio Institucional para Usuarios Loggeados
		if (JFactory::getUser()->id == 0){
				echo "<a href=\"index.php/repo-inv\" class=\"tituloshd hdrepo\">Repositorio Institucional</a>";
		}
		else{
				echo "<a href=\"http://www.riudg.udg.mx/\" target=\"_blank\" class=\"tituloshd hdrepo\">Repositorio Institucional</a>";
		}
		?>
		<a href="index.php/catalogos-linea" class="tituloshd hdcatalogosl">Cat&aacute;logos en l&iacute;nea</a>
		<a href="index.php/herramientas" class="tituloshd hdherramientas">Herramientas</a>
		<a href="index.php/ser-bib" class="tituloshd hdserviciosb">Servicios Bibliotecarios</a>
	</nav>
	</div>
</menuMovilJM>
<!--*******************************  FIN MENU MOVIL     ****************************************-->