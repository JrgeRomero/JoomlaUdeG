<?php
    define('_JEXEC', 1);

    if (file_exists(__DIR__ . '/defines.php'))
    {
	include_once __DIR__ . '/defines.php';
    }

    if (!defined('_JDEFINES'))
    {
    	define('JPATH_BASE', __DIR__);
    	require_once JPATH_BASE . '/includes/defines.php';
    }

    require_once JPATH_BASE . '/includes/framework.php';

    function startsWith($haystack, $needle){
         $length = strlen($needle);
         return (substr($haystack, 0, $length) === $needle);
    }

    function invitadoRED(){
        $mainframe = JFactory::getApplication('site');

        $mainframe->initialise();

        $credentials = array( 'username' => 'invitado', 'password' => '0d411Vn1');
        $mainframe->login($credentials, $options=array());

        header('Location: /index.php');

    }

    function invitadoEXT(){
        $mainframe = JFactory::getApplication('site');

        $mainframe->initialise();

        $credentials = array( 'username' => 'invitado.', 'password' => '0d411Vn1Txe');
        $mainframe->login($credentials, $options=array());

        header('Location: /index.php');

    }

 
    if (!empty($_SERVER ['HTTP_CLIENT_IP'] ))
      $ip=$_SERVER ['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'] ))
      $ip=$_SERVER ['HTTP_X_FORWARDED_FOR'];
    else
      $ip=$_SERVER ['REMOTE_ADDR'];
    //echo "<p>".$ip."</p>";
    if(startsWith($ip,"148.202.")){
            echo "<p>IP valida!</p>";
            invitadoRED();
    }else if(startsWith($ip,"202.39.173.")){
            echo "<p>IP valida!</p>";
	    invitadoRED();
    }else if(startsWith($ip,"187.130.160.")){
            echo "<p>IP valida!</p>";
            invitadoRED();
    }else if(startsWith($ip,"200.39.160.")){
            echo "<p>IP valida!</p>";
            invitadoRED();
    }else if(startsWith($ip,"207.249.224.")){
            echo "<p>IP valida!</p>";
            invitadoRED();
    }else{
            echo "<p>IP invalida</p>";
            invitadoEXT();
    }

?>