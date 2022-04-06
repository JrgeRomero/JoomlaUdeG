<?php
/**
* @version   $Id: unsupported.php 24982 2014-12-31 19:50:04Z kat $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2021 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once(dirname(__FILE__).'/lib/gantry/gantry.php');
$gantry->init();

$doc = JFactory::getDocument();

$gantry->addStyle('grid-responsive.css', 5);
$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);

$gantry->addLess('global.less', 'master.css', 8, array('main-accent'=>$gantry->get('main-accent','#519bda'), 'main-accent2'=>$gantry->get('main-accent2', '#e7714d'), 'main-body'=>$gantry->get('main-body', 'light'), 'main-showcasebg'=>$gantry->get('main-showcasebg', 'abstract')));

ob_start();
?>
	<body <?php echo $gantry->displayBodyTag(); ?>>
		<?php /** Begin Navigation **/ if ($gantry->countModules('navigation')) : ?>
		<div id="rt-navigation">
			<div class="rt-container">
				<div class="rt-grid-12">
					<div class="rt-block logo-block">
						<a href="<?php echo $gantry->baseUrl; ?>" id="rt-logo"><?php if ($gantry->get('logo-type') == 'fracture' && $gantry->get('main-body') == 'dark') :?><span class="logo-color"></span><?php endif; ?></a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Navigation **/ endif; ?>
			<div class="rt-container rt-dark">
				<div id="rt-body-surround">
					<div class="rt-grid-12">
				    	<div class="rt-block component-block unsupported box2">
				            <h1>Unsupported Browser</h1>
				            <p>We have detected that you are using Internet Explorer 7, a browser version that is not supported by this website. Internet Explorer 7 was released in October of 2006, and the latest version of IE7 was released in October of 2007. It is no longer supported by Microsoft.</p>
				            <p>Continuing to run IE7 leaves you open to any and all security vulnerabilities discovered since that date. In October 2013, Microsoft released version 11 of Internet Explorer that, in addition to providing greater security, is faster and more standards compliant than versions 6-10 that came before it.</p>
				            <p>We suggest installing the <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">latest version of Internet Explorer</a>, or the latest version of these other popular browsers: <a href="http://www.mozilla.com/en-US/firefox/firefox.html">Firefox</a>, <a href="http://www.google.com/chrome">Google Chrome</a>, <a href="http://www.apple.com/safari/download/">Safari</a>, <a href="http://www.opera.com/">Opera</a></p>
				 		</div>
				 	</div>
				 	<div class="clear"></div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php

$body = ob_get_clean();
$gantry->finalize();

if (!class_exists('JDocumentRendererHead')) {
    require_once(JPATH_LIBRARIES.'/joomla/document/html/renderer/head.php');
}
$header_renderer = new JDocumentRendererHead($doc);
$header_contents = $header_renderer->render(null);
ob_start();
?>
<!DOCTYPE html>
<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<?php echo $header_contents; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
$header = ob_get_clean();
echo $header.$body;;

