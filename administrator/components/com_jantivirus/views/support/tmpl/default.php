<?php
/**
 * @package	Antivirus
 * @copyright	Copyright (C) 2014 SiteGuarding.com. All rights reserved.
 * @license	GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');

$session = JFactory::getSession();
$license_info = $session->get('jantivirus_license_info');
?>

<div class="ui_container">

<h2 class="ui dividing header"><?php echo JText::_('COM_JANTIVIRUS_TITLE_FREE_SUPPORT'); ?></h2>

<p class="avp_getpro"><a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain=<?php echo urlencode( JURI::root() ); ?>&email=<?php echo urlencode($license_info['email']); ?>" target="_blank"><?php echo JText::_('COM_JANTIVIRUS_MSG_GET_PRO'); ?></a></p>

<p>
<?php echo JText::_('COM_JANTIVIRUS_MSG_FOR_MORE_INFORMATION'); ?><br /><br />
<a href="http://www.siteguarding.com/livechat/index.html" target="_blank">
	<img src="<?php echo '../media/com_jantivirus/images/livechat.png'; ?>"/>
</a><br />
<?php echo JText::_('COM_JANTIVIRUS_MSG_FOR_ANY_QUESTION_USE'); ?><br>
<br>
<?php echo JText::_('COM_JANTIVIRUS_MSG_PROFESSIONAL_SECURITY'); ?><br />
</p>

<div style="width:100%">
	<fieldset class="adminform">
	  <legend><?php echo JText::_('COM_JANTIVIRUS_TITLE_CRON_SETTINGS'); ?></legend>
		
		<p>
		<?php echo JText::_('COM_JANTIVIRUS_MSG_DAILY_SCAN'); ?><br /><br />
		<b>Unix time settings:</b> 0 0 * * *<br />
		<b>Command:</b> wget -O /dev/null "<?php echo str_replace("/administrator/", "/", JURI::base()); ?>index.php?option=com_jantivirus&action=cron&access_key=<?php echo $license_info['access_key']; ?>"
		</p>
	</fieldset>
</div>

</div>

