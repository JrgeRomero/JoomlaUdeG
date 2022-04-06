<?php
/**
* @version   $Id: error.php 26106 2015-01-27 14:22:15Z james $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2021 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*
* Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
*
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

// load and inititialize gantry class
global $gantry;
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

$doc = JFactory::getDocument();
$doc->setTitle($this->error->getCode() . ' - '.$this->title);

		$gantry->addStyle('grid-responsive.css', 5);
		$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);
        $gantry->addLess('global.less', 'master.css', 8, array('main-accent'=>$gantry->get('main-accent','#519bda'), 'main-accent2'=>$gantry->get('main-accent2', '#e7714d'), 'main-body'=>$gantry->get('main-body', 'light'), 'main-showcasebg'=>$gantry->get('main-showcasebg', 'abstract')));

        if ($gantry->browser->name == 'ie'){
        	if ($gantry->browser->shortversion == 9){
        		$gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
        	}
			if ($gantry->browser->shortversion == 8){
				$gantry->addScript('html5shim.js');
			}
		}
$gantry->addScript('rokmediaqueries.js');

ob_start();
?>
<body <?php echo $gantry->displayBodyTag(); ?>>
	<header id="rt-top-surround">
		<div id="rt-header">
			<div class="rt-container">
				<?php echo $gantry->displayModules('header','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
	</header>
	<div class="rt-container">
		<div class="component-content">
			<div class="rt-grid-12">
				<div class="rt-block box1 rt-error-block">
					<div class="rt-error-content">
						<h1 class="error-title title">Error: <span><?php echo $this->error->getCode(); ?></span> - <?php echo $this->error->getMessage(); ?></h1>
						<div class="error-content">
						<p><strong>You may not be able to visit this page because of:</strong></p>
						<ol>
							<li>an out-of-date bookmark/favourite</li>
							<li>a search engine that has an out-of-date listing for this site</li>
							<li>a mistyped address</li>
							<li>you have no access to this page</li>
							<li>The requested resource was not found.</li>
							<li>An error has occurred while processing your request.</li>
						</ol>
						<p><a href="<?php echo $gantry->baseUrl; ?>" class="readon"><span>&larr; Home</span></a></p>
					</div>
				</div>
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
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
	<meta name="viewport" content="width=960px">
	<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
	<meta name="viewport" content="width=1200px">
	<?php else : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php endif; ?>
</head>
<?php
$header = ob_get_clean();
echo $header.$body;;
