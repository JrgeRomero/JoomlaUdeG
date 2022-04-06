<?php
//exit();
session_start(); 

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

		$mainframe =& JFactory::getApplication('site');
		$mainframe->initialise();

if (JFactory::getUser()->id == 0){
	header("Location: https://wdg.biblio.udg.mx");
	exit();
}

/*header("Location: https://wdg.biblio.udg.mx");
exit();*/


$session = JFactory::getSession();

$user = JFactory::getUser();

/**
 * @param   string $useremail Email address of user to create token for.
 * @param   string $firstname First name of user (used to update/create user).
 * @param   string $lastname Last name of user (used to update/create user).
 * @param   string $username Username of user (used to update/create user).
 * @param   string $ipaddress IP address of end user that login request will come from (probably $_SERVER['REMOTE_ADDR']).
 * @param int      $courseid Course id to send logged in users to, defaults to site home.
 * @param int      $modname Name of course module to send users to, defaults to none.
 * @param int      $activityid cmid to send logged in users to, defaults to site home.
 * @return bool|string
 */
function getloginurl($useremail, $firstname, $lastname, $username, $courseid = null, $modname = null, $activityid = null) {
    require_once('PHP-REST/curl.php');

    //$token        = '822a2dc2dbfcb4f084d9c0abaa9d11fe';
    $token	  = '19cf79aee74cf0e08ba3ba72758c9ef3';
    $domainname   = 'http://148.202.195.115';
    $functionname = 'auth_userkey_request_login_url';
    //$functionname = 'core_user_create_users';

    $param = [
        'user' => [
            'firstname' => $firstname, // You will not need this parameter, if you are not creating/updating users
            'lastname'  => $lastname, // You will not need this parameter, if you are not creating/updating users
            'username'  => $username, 
            'email'     => $useremail
        ]
    ];


    /*Funciones para manejo de usuarios en Moodle
	1- core_user_create_users (crear usuarios con una contraseña)
	
    */

    //Params para core_user_create_users	
    //$param = "&users[0][password]=wdgMODS1IAU#&users[0][firstname]=".$firstname."&users[0][lastname]=".$lastname."&users[0][username]=".$username."&users[0][email]=".$useremail;

    $serverurl = $domainname . '/webservice/rest/server.php' . '?wstoken=' . $token . '&wsfunction=' . $functionname . '&moodlewsrestformat=json';
    $curl = new curl; // The required library curl can be obtained from https://github.com/moodlehq/sample-ws-clients 

    try {
        $resp     = $curl->post($serverurl, $param);
	echo "Resp:".$resp;var_dump($resp);
        $resp     = json_decode($resp);
        if ($resp && !empty($resp->loginurl)) {
            $loginurl = $resp->loginurl;        
        }
	else{
	    echo "No hay respuesta";
	}
    } catch (Exception $ex) {
	//echo "exp";
        return false;
    }

    if (!isset($loginurl)) {
//echo "login";
        return false;
    }

    $path = '';
    if (isset($courseid)) {
        $path = '&wantsurl=' . urlencode("$domainname/course/view.php?id=$courseid");
    }
    if (isset($modname) && isset($activityid)) {
        $path = '&wantsurl=' . urlencode("$domainname/mod/$modname/view.php?id=$activityid");
    }

    return $loginurl . $path;
}

function getloginurlOnlyLogin($username, $courseid = null, $modname = null, $activityid = null) {
    require_once('PHP-REST/curl.php');

    //$token        = '822a2dc2dbfcb4f084d9c0abaa9d11fe';
    $token	  = '19cf79aee74cf0e08ba3ba72758c9ef3';
    $domainname   = 'http://148.202.195.115';
    $functionname = 'auth_userkey_request_login_url';
    //$functionname = 'core_user_create_users';

    $param = [
        'user' => [
            'username'  => $username
        ]
    ];


    /*Funciones para manejo de usuarios en Moodle
	1- core_user_create_users (crear usuarios con una contraseña)
    */

    //Params para core_user_create_users	
    //$param = "&users[0][password]=wdgMODS1IAU#&users[0][firstname]=".$firstname."&users[0][lastname]=".$lastname."&users[0][username]=".$username."&users[0][email]=".$useremail;

    $serverurl = $domainname . '/webservice/rest/server.php' . '?wstoken=' . $token . '&wsfunction=' . $functionname . '&moodlewsrestformat=json';
    $curl = new curl; // The required library curl can be obtained from https://github.com/moodlehq/sample-ws-clients 

    try {
        $resp     = $curl->post($serverurl, $param);
	echo "Resp:".$resp;var_dump($resp);
        $resp     = json_decode($resp);
        if ($resp && !empty($resp->loginurl)) {
            $loginurl = $resp->loginurl;        
        }
	else{
	    echo "No hay respuesta";
	    return false;
	}
    } catch (Exception $ex) {
	//echo "exp";
        return false;
    }

    if (!isset($loginurl)) {
//echo "login";
        return false;
    }

    $path = '';
    if (isset($courseid)) {
        $path = '&wantsurl=' . urlencode("$domainname/course/view.php?id=$courseid");
    }
    if (isset($modname) && isset($activityid)) {
        $path = '&wantsurl=' . urlencode("$domainname/mod/$modname/view.php?id=$activityid");
    }

    return $loginurl . $path;
}

function san_email($email){
	$email = strip_tags(str_replace(array('"', "'", '`', '´', '¨'), '', trim($email)));
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
	return $email;
}
		
function isEmail($email){
	$email = san_email($email);
	$true_email = filter_var($email, FILTER_VALIDATE_EMAIL);
	if($true_email)
		return $email;
	else{
		return false;
	}
}

function confirm_pass($pass1,$pass2){
	if(strcmp($pass1,$pass2) == 0){
		return true;
	}else{
		return false;
	}
}


//$loginURL =  getloginurl($user->get('email'), $user->get('name'), '', $user->get('username'));
$usrnamefull = $session->get("CODE");
if(strcmp($user->get('username'),"siiau") == 0){

	$loginURL =  getloginurlOnlyLogin($user->get('username')."-".$usrnamefull);
	
	if($loginURL == false && !isset($_POST['correo_moodle'])){
		header("Location: https://wdg.biblio.udg.mx/AltaUsersFirstLogin.php");
		exit();
	}
	else if($loginURL == false && isset($_POST['correo_moodle'])){
		$correct_email = isEmail($_POST['correo_moodle']);
		$same_passwords = confirm_pass($_POST['correo_moodle'],$_POST['conf_correo_moodle']);
		if($correct_email != false && $same_passwords == true)
			$loginURL =  getloginurl($correct_email."", $session->get("CODE"), $session->get("NAME_USERSIIAU"),  $user->get('username')."-".$usrnamefull);
		else{
			header("Location: https://wdg.biblio.udg.mx/AltaUsersFirstLogin.php?error=nomailormatch");
			exit();
		}
	}
}else{
	$loginURL =  getloginurlOnlyLogin("wdg-".$user->get('username'));

	if($loginURL == false && !isset($_POST['correo_moodle'])){
		header("Location: https://wdg.biblio.udg.mx/AltaUsersFirstLogin.php");
		exit();
	}
	else if($loginURL == false && isset($_POST['correo_moodle'])){
		$correct_email = isEmail($_POST['correo_moodle']);
		$same_passwords = confirm_pass($_POST['correo_moodle'],$_POST['conf_correo_moodle']);
		if($correct_email != false && $same_passwords == true)
			$loginURL =  getloginurl($correct_email."", $session->get("CODE"), $session->get("NAME_USERSIIAU"),  "wdg-".$user->get('username'));
		else{
			header("Location: https://wdg.biblio.udg.mx/AltaUsersFirstLogin.php?error=nomailormatch");
			exit();
		}
	}
}
//echo "CODIGO-SIIAU:".$session->get("CODE")."<br>";
//echo "FULLNAME:".$session->get("NAME_USERSIIAU")."<br>";
//echo "USERNAME:".$user->get('username')."<br>";
echo "URL".$loginURL;
echo "Autenticando en wdg.aula...";
//exit;

header("Location: " . $loginURL);

//exit;


