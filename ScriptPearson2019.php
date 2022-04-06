<?php

# ------------------------------

# Empiezo de Configuración de $launch

#

# Definiciones de los variables:

# user_id = ID del usuario

# roles = Papel (estudiante o profesor) (seleccione uno)

# lis_person_name_full = Nombre completo de usuario

# lis_person_name_family = Apellido

# lis_person_name_given = Nombre

# lis_person_contact_email_primary = Cuenta de correo electrónico del usuario

#

# key: llave compartida

# secret: Secreto compartido





$launch_url = "https://bc.vitalsource.com/bookshelf";

$key = "14c28360-23dc-11e9-b56e-0800200c9a66";

$secret = "444c3041595c4529643e697c582d5c3f";



$launch_data = array(

	"user_id" => "12345",

	"roles" => "Papel (estudiante o profesor) (seleccione uno)",

	"lis_person_name_full" => "Biblioteca Digital",

	"lis_person_name_family" => "Apellido",

	"lis_person_name_given" => "Nombre",

	"lis_person_contact_email_primary" => "bibliotecadigital@redudg.udg.mx",

);



#

# Fin de configuración

# ------------------------------



$now = new DateTime();



$launch_data["lti_version"] = "LTI-1p0";

$launch_data["lti_message_type"] = "basic-lti-launch-request";



# Basic LTI uses OAuth to sign requests

# OAuth Core 1.0 spec: http://oauth.net/core/1.0/



$launch_data["oauth_callback"] = "about:blank";

$launch_data["oauth_consumer_key"] = $key;

$launch_data["oauth_version"] = "1.0";

$launch_data["oauth_nonce"] = uniqid('', true);

$launch_data["oauth_timestamp"] = $now->getTimestamp();

$launch_data["oauth_signature_method"] = "HMAC-SHA1";



# In OAuth, request parameters must be sorted by name

$launch_data_keys = array_keys($launch_data);

sort($launch_data_keys);



$launch_params = array();

foreach ($launch_data_keys as $key) {

  array_push($launch_params, $key . "=" . rawurlencode($launch_data[$key]));

}



$base_string = "POST&" . urlencode($launch_url) . "&" . rawurlencode(implode("&", $launch_params));

$secret = urlencode($secret) . "&";

$signature = base64_encode(hash_hmac("sha1", $base_string, $secret, true));



?>



<html>

<head></head>

<body onload="document.ltiLaunchForm.submit();">

<!--<body>-->

<form id="ltiLaunchForm" name="ltiLaunchForm" method="POST" action="<?php printf($launch_url); ?>">

<?php foreach ($launch_data as $k => $v ) { ?>

	<input type="hidden" name="<?php echo $k ?>" value="<?php echo $v ?>">

<?php } ?>

	<input type="hidden" name="oauth_signature" value="<?php echo $signature ?>">

	<button type="submit">Launch</button>

</form>

<body>

</html>

