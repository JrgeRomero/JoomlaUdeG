<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<!--<link rel="stylesheet" href="css/system_style.css">
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>-->
		<title>Alta de usuario Moodle, primer ingreso</title>
		<style>
			*{
				margin: 0 auto;
				font-family: 'Trebuchet MS', sans-serif;
			}
			body{
				max-width: 800px;
				margin-top: 10%;
				-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
				-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
				box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			}
			p{
				font-size: 18px;
			}
			label{
				display:block;
				width: 300px;
				font-size: 18px;
				margin-left: 0px;
			}
			#recuadro_title{
				max-width: 1170px;
				padding-left:20px;
				padding-top:20px;
				padding-bottom:20px;
				color: #FFF;
				background-color: #9e3e20;
			}
			#recuadro_login_moodle{
				max-width: 800px;
				padding: 20px;
			}
			.forminputtext_long{
				height: 36px;
				width: 400px;
				padding-left: 10px;
				-webkit-border-radius: 6px;
				-moz-border-radius: 6px;
				border-radius: 6px;
				border: 1px solid #A2A2A2;
				font-size: 18px;
			}
			#botonaceptarlogin{
				font-size: 18px;
				padding:12px;
				color:#212529;
				background-color:#ced4da;
			}
			#botonaceptarlogin:hover{
				font-size: 18px;
				padding:12px;
				color:#FFF;
				background-color:#767676;
			}
			.red_text{
				color: red;
			}
		</style>
	</head>
	<body>
		<div id="recuadro_title">
			<h1>¡Bienvenido a wdg.aula!</h1>
		</div>
		<div id="recuadro_login_moodle">
		<p>Estás a punto de ingresar a wdg.aula de la Biblioteca Digital UDG, detectamos que es la primera vez que ingresas por lo que requerimos que nos proporciones por favor tu correo electrónico
		para enlazarlo a tu cuenta y así los cursos y actividades que realices dentro de la plataforma puedan estár en contacto contigo.
		</p><br>
		<?php
			if(isset($_GET['error'])){
				if(strcmp($_GET['error'],"nomailormatch") == 0){
					echo "<p class='red_text'>ERROR: Correo inválido o no coincide el correo ingresado.</p><br>";
				}
			}
		?>
		<form id="formularioEnviarCorreo" enctype="multipart/form-data" method="post" action="wdg_aula.php">
			<label><b>Correo electrónico:</b></label>
			<input type="text" name="correo_moodle" class="forminputtext_long" placeholder="Escriba aquí su correo electrónico" required><br>
			<label><b>Confirme su correo:</b></label>
			<input type="text" name="conf_correo_moodle" class="forminputtext_long" placeholder="Vuelva a escribir su correo para confirmarlo" required>
		</form><br>
		<button id="botonaceptarlogin" type="submit" form="formularioEnviarCorreo" value="Submit">Aceptar</button>
		</div>
	</body>
</html>