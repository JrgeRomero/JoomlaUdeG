<html>
<head>
	<title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
</body>
</html>
<?php
	//Constantes 
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);
	
	//Variables de Formulario
	$tireqty = $_POST['tireqty'];
	$oilqty = $_POST['oilqty'];
	$sparkqty = $_POST['sparkqty'];
	$find = $_POST['find'];
	
	echo "<p>Order Processed at ";
	echo date('H:i a, jS F');
	echo "</p>";
	if($tireqty > 0 || $oilqty > 0 || $sparkqty > 0){
		echo "<p>Your order is a follows: </p>";
		if($tireqty > 0){
			echo "$tireqty tires <br />";
			echo '$tireqty tires <br />';
		}
		if($oilqty > 0)
			echo $oilqty." bottles of oil <br />";
		if($sparkqty > 0)		
			echo $sparkqty." spark plugs <br />";
		if($find == 'a')
		echo '<p>Cliente Regular.</p>';
		elseif($find == 'b')
			echo '<p>El cliente se enteró por un anuncio de TV.</p>';		
		elseif($find == 'c')
			echo '<p>El cliente se enteró por un directorio telefónico.</p>';		
		elseif($find == 'd')
			echo '<p>El cliente se enteró por que se lo dijeron.</p>';		
	}
	else{
		echo '<font color=red>';
		echo '<p>No has ordenado nada.</p>';
		echo '</font>';
	}
	
	//Variables normales
	$totalqty = 0;
	$totalqty = $tireqty + $oilqty + $sparkqty;
	$totalamount = 0;
	$totalamount = ($tireqty * TIREPRICE) + ($oilqty * OILPRICE) + ($sparkqty * SPARKPRICE);
	
	
	/*Verficacion de variables
	echo 'isset($tireqty): '.isset($tireqty).'<br />';
	echo 'isset($nothere): '.isset($nothere).'<br />';
	echo 'empty($tireqty): '.empty($tireqty).'<br />';
	echo 'empty($nothere): '.empty($nothere).'<br />';*/
?>