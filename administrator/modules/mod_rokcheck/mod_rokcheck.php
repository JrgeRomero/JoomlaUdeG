<?php
/**
 * @package   RokCheck Module entry point
 * @author    RocketTheme - Mark Taylor (a.k.a MrT) https://rockettheme.com
 * @copyright Copyright (C) 2007 - 2019 RocketTheme, LLC
 * @license   GNU/GPLv2 and later
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

// Include the simple html dom functions only once
require_once dirname(__FILE__) . '/simple_html_dom.php';

$results = ModRokcheckHelper::getResults($params);
require JModuleHelper::getLayoutPath('mod_rokcheck');