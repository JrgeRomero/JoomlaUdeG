<?php

# Declaración de variable
$erecurso_url = $_GET["url"];
$user = "wdgapp";
$pass = "4ptsWDGn3r";

#Forma URL
$proxyurl = "http://wdg.biblio.udg.mx:2048/login?user=".$user."&pass=".$pass."&url=".$erecurso_url;

#Redirección
header("Location: ".$proxyurl);

?>
