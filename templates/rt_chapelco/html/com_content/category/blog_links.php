<?php
/**
* @version   $Id: blog_links.php 26106 2015-01-27 14:22:15Z james $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2021 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die;
$gantry_lib_path = JPATH_SITE . '/libraries/gantry/gantry.php';
if (!file_exists($gantry_lib_path)) {
    echo 'This template requires the Gantry Template Framework.  Please download and install from <a href="http://www.gantry-framework.org/download">http://www.gantry-framework.org/download</a>';
    die;
}
include(JPATH_LIBRARIES.'/gantry/gantry.php');
$gantry->init();
include JPATH_SITE.'/templates/'.$gantry->getCurrentTemplate().'/html/base_override.php';