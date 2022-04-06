<?php
/* Este es un servicio REST que sirve para actualizar la lista de recursos electronicos
* de la biblioteca de la WDG.
* Regresa los resultados en formato tipo JSON
* eScire 2019 - Gerardo Flores
*/

// Creamos el formato Json
function StringToJson($string)
{
    $MyObj = new stdClass;
    $e_recursos = explode("*-.-*", str_replace("\n", "", $string));
    if (count($e_recursos) == 5) {
      $MyObj->Name = $e_recursos[0];
      $MyObj->Description = $e_recursos[1];
      $MyObj->UrlSite = $e_recursos[2];
      $MyObj->ImageUrl = $e_recursos[3];
      $MyObj->Notes = $e_recursos[4];
    }
    else {
      $MyObj->Name = $e_recursos[0];
      $MyObj->Description = $e_recursos[1];
      $MyObj->UrlSite = $e_recursos[2];
      $MyObj->ImageUrl = $e_recursos[3];
      $MyObj->Notes = '';
    }
    return $MyObj;
}

  $data = array();
  $fp = fopen("RecursosElectronicos.txt", "r");
  while (!feof($fp)){
      $linea = fgets($fp);
      if (strlen($linea) != 0) {
          $data[] = StringToJson($linea);
      }
  }
  fclose($fp);

  //Convertimos a formato Json
  $myJSON = json_encode($data);
  echo $myJSON;

 ?>
