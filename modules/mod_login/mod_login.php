<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the login functions only once
JLoader::register('ModLoginHelper', __DIR__ . '/helper.php');

$params->def('greeting', 1);

$type             = ModLoginHelper::getType();
$return           = ModLoginHelper::getReturnUrl($params, $type);
$twofactormethods = JAuthenticationHelper::getTwoFactorMethods();

$session = JFactory::getSession();
if(strlen($session->get("NAME_USERSIIAU"))>0){
	$primernombre = explode(" ", $session->get("NAME_USERSIIAU"));
	if(strlen($primernombre[0])>0)
		echo "Hola, ".$primernombre[0];
}
else{
	$primernombre = explode(" ", JFactory::getUser()->name);
	if(strlen($primernombre[0])>0){
		echo "Hola, ".$primernombre[0];
		$session->set('CODE', "".JFactory::getUser()->username."");
		$session->set('NAME_USERSIIAU', "".JFactory::getUser()->name."");
	}
}

$user             = JFactory::getUser();
$layout           = $params->get('layout', 'default');

// Logged users must load the logout sublayout
if (!$user->guest)
{
	$layout .= '_logout';
}

require JModuleHelper::getLayoutPath('mod_login', $layout);
