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
//print_r($license_info);

	function PrepareDomain($domain)
	{
	    $host_info = parse_url($domain);
	    if ($host_info == NULL) return false;
	    $domain = $host_info['host'];
	    if ($domain[0] == "w" && $domain[1] == "w" && $domain[2] == "w" && $domain[3] == ".") $domain = str_replace("www.", "", $domain);
	    //$domain = str_replace("www.", "", $domain);
	    
	    return $domain;
	}
	
$domain = PrepareDomain( JURI::root() );
/*
if (intval($license_info['scans']) == 0) 
{
	JError::raiseWarning( 100, JText::_('COM_JANTIVIRUS_MSG_VERSION_HAS_LIMITS') );
}
*/

?>
<div class="ui_container">

<h2 class="ui dividing header"><?php echo JText::_('COM_JANTIVIRUS_SUBMENU_SCANNER'); ?></h2>


<div style="max-width:800px">


<div style="width:60%; float:left; margin-bottom:20px">
    <div class="ui list">
        <p class="item"><?php echo JText::_('COM_JANTIVIRUS_CONFIG_LABEL_GOOGLE_BLACKLIST'); ?><?php if ($license_info['blacklist']['google'] != 'ok') echo '<span class="ui red label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_BLACKLISTED').' ['.$license_info['blacklist']['google'].']</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_REMOVE_FROM_BLACKLIST').'</a>]'; else echo JText::_('COM_JANTIVIRUS_CONFIG_LABEL_NOT_BLACKLISTED'); ?></p>
        <p class="item"><?php echo JText::_('COM_JANTIVIRUS_CONFIG_LABEL_MONITORING'); ?><?php if ($license_info['filemonitoring']['status'] == 0) echo '<span class="ui red label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_DISABLED').'</span> [<a href="https://www.siteguarding.com/en/protect-your-website" target="_blank">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_SUBSCRIBE').'</a>]'; else echo '<b>'.$license_info['filemonitoring']['plan'].'</b> ['.$license_info['filemonitoring']['exp_date'].']'; ?></p>
        <?php
        if (count($license_info['reports']) > 0) 
        {
            if ($license_info['last_scan_files_counters']['main'] == 0 && $license_info['last_scan_files_counters']['heuristic'] == 0) echo '<p class="item">'.JText::_('COM_JANTIVIRUS_WEBSITE_STATUS').'<span class="ui green label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_CLEAN').'</span></p>';
            if ($license_info['last_scan_files_counters']['main'] > 0) echo '<p class="item">'.JText::_('COM_JANTIVIRUS_WEBSITE_STATUS').'<span class="ui red label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_INFECTED').'</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">'.JText::_('COM_JANTIVIRUS_BTTN_CLEAN_SITE').'</a>]</p>';
            else if ($license_info['last_scan_files_counters']['heuristic'] > 0)  echo '<p class="item">'.JText::_('COM_JANTIVIRUS_WEBSITE_STATUS').'<span class="ui red label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_REVIEW_REQUIRED').'</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_REVIEW_SITE').'</a>]</p>';
        }
        else {
            echo '<p class="item">'.JText::_('COM_JANTIVIRUS_WEBSITE_STATUS').'<span class="ui red label">'.JText::_('COM_JANTIVIRUS_CONFIG_LABEL_NEVER').'</span></p>';
        }
        ?>
    </div>
</div>


<div style="width:40%; float:left; margin-bottom:20px">
    <div class="ui list">
    	<?php
    	$txt = $license_info['membership'];
    	if ($txt != 'pro') $txt = ucwords($txt);
    	else $txt = '<span class="ui green label">'.ucwords($txt).'<span>';
    	?>
        <p class="item"><?php echo JText::_('COM_JANTIVIRUS_CONFIG_LABEL_SUBSCRIPTION'); ?><b><?php echo $txt; ?></b><?php echo JText::_('COM_JANTIVIRUS_CONFIG_LABEL_VERSION'); ?><?php echo SGAntiVirus::$antivirus_version; ?></p>
        <p class="item"><?php echo JText::_('COM_JANTIVIRUS_MSG_FREE_SCANS'); ?>: <?php echo $license_info['scans']; ?></p>
        <p class="item"><?php echo JText::_('COM_JANTIVIRUS_MSG_VALID_TILL'); ?>: <?php echo $license_info['exp_date']."&nbsp;&nbsp;"; 
        if ($license_info['exp_date'] < date("Y-m-d")) echo '<span class="ui red label">'.JText::_('COM_JANTIVIRUS_MSG_EXPIRED').'</span> [<a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain='.urlencode( JURI::root() ).'&email='.urlencode($license_info['email']).'" target="_blank">Upgrade</a>]';
        else if ($license_info['exp_date'] < date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")))) echo '<span class="msg_box msg_warning">'.JText::_('COM_JANTIVIRUS_MSG_WILL_EXPIRE_SOON').'</span>';
        ?></p>

    </div>
</div>

</div>


<div style="clear:both"></div>

<?php /*
<div class="ui list">
	<?php
	$txt = $license_info['membership'];
	if ($txt != 'pro') $txt = ucwords($txt);
	else $txt = '<span class="ui green label">'.ucwords($txt).'<span>';
	?>
    <p class="item">Your subscription: <b><?php echo $txt; ?></b> (ver. <?php echo SGAntiVirus::$antivirus_version; ?>)</p>
    <p class="item"><?php echo JText::_('COM_JANTIVIRUS_MSG_FREE_SCANS'); ?>: <?php echo $license_info['scans']; ?></p>
    <p class="item"><?php echo JText::_('COM_JANTIVIRUS_MSG_VALID_TILL'); ?>: <?php echo $license_info['exp_date']."&nbsp;&nbsp;"; 
    if ($license_info['exp_date'] < date("Y-m-d")) echo '<span class="ui red label">'.JText::_('COM_JANTIVIRUS_MSG_EXPIRED').'</span> [<a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain='.urlencode( JURI::root() ).'&email='.urlencode($license_info['email']).'" target="_blank">Upgrade</a>]';
    else if ($license_info['exp_date'] < date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")-7, date("Y")))) echo '<span class="msg_box msg_warning">'.JText::_('COM_JANTIVIRUS_MSG_WILL_EXPIRE_SOON').'</span>';
    ?><br />
    <p class="item">Google Blacklist Status: <?php if ($license_info['blacklist']['google'] != 'ok') echo '<span class="ui red label">Blacklisted ['.$license_info['blacklist']['google'].']</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">Remove From Blacklist</a>]'; else echo '<span class="ui green label">Not blacklisted</span>'; ?></p>
    <p class="item">File Change Monitoring: <?php if ($license_info['filemonitoring']['status'] == 0) echo '<span class="ui red label">Disabled</span> [<a href="https://www.siteguarding.com/en/protect-your-website" target="_blank">Subscribe</a>]'; else echo '<b>'.$license_info['filemonitoring']['plan'].'</b> ['.$license_info['filemonitoring']['exp_date'].']'; ?></p>
    <?php
    if (count($license_info['reports']) > 0) 
    {
        if ($license_info['last_scan_files_counters']['main'] == 0 && $license_info['last_scan_files_counters']['heuristic'] == 0) echo '<p class="item">Website Status: <span class="ui green label">Clean</span></p>';
        if ($license_info['last_scan_files_counters']['main'] > 0) echo '<p class="item">Website Status: <span class="ui red label">Infected</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">Clean My Website</a>]</p>';
        else if ($license_info['last_scan_files_counters']['heuristic'] > 0)  echo '<p class="item">Website Status: <span class="ui red label">Review is required</span> [<a href="https://www.siteguarding.com/en/services/malware-removal-service" target="_blank">Review My Website</a>]</p>';
    }
    else {
        echo '<p class="item">Website Status: <span class="ui red label">Never Analyzed</span></p>';
    }
    ?>
</div>
*/ ?>

<?php
/*
if (trim($license_info['membership']) == 'pro') $license_text = JText::_('COM_JANTIVIRUS_MSG_YOU_HAVE_PRO');
else $license_text = JText::_('COM_JANTIVIRUS_MSG_GET_PRO');
*/
if (trim($license_info['membership']) != 'pro') 
{
    $license_text = JText::_('COM_JANTIVIRUS_MSG_GET_PRO');
?>
<div class="ui message warning" style="max-width:760px">
    <p><a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain=<?php echo urlencode( JURI::root() ); ?>&email=<?php echo urlencode($license_info['email']); ?>" target="_blank"><?php echo $license_text; ?></a></p>
</div>
<?php
}
?>


<div class="mod-box"><div>		
<p><?php echo JText::_('COM_JANTIVIRUS_MSG_START_SCANNER'); ?></p>
<p><?php echo JText::_('COM_JANTIVIRUS_MSG_SCANNER_WILL_COLLECT'); ?></p>
<p><?php echo JText::_('COM_JANTIVIRUS_MSG_AFTER_ANALYZE'); ?></p>

			
		<form method="post" action="index.php">
		
        
		<div class="startscanner">
            <p style="text-align: center;">
		      <input type="submit" name="submit" id="submit" class="huge ui green button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_START_SCANNER'); ?>">
          </p>
		</div>
		
		<input type="hidden" name="option" value="com_jantivirus"/>
		<input type="hidden" name="view" value="scan"/>
		
		</form>
		
		<p style="text-align:center" class="label_error">If your Joomla website is hacked or core files are corrupted. The viruses can block the normal scanning process. Please use alternative method.</p>
		<p style="text-align:center">You will be redirected to SiteGuarding.com and server will start the scanning process even if your Joomla CMS is not stable.</p>

		<div class="startscanner">
            <p style="text-align: center;">
		      <a class="huge ui green button" href="<?php echo 'https://www.siteguarding.com/en/website-antivirus-scanner?domain='.$domain.'&sess='.md5($license_info['access_key']).'&anticache='.time(); ?>" target="_blank">Start Scanner (safe mode)</a>
          </p>
		</div>
		
<p><?php echo JText::_('COM_JANTIVIRUS_ONLINE_TOOL'); ?> <a target="_blank" href="https://www.siteguarding.com/en/website-antivirus">Click here</a></p>


<h3 class="ui dividing header"><?php echo JText::_('COM_JANTIVIRUS_TITLE_EXTRA'); ?></h3>

	<div class="divTable avpextraoption">
	
	<div class="divRow">
	<div class="divCell avpextraoption_txt"><?php echo JText::_('COM_JANTIVIRUS_MSG_GOT_HACKED'); ?></div>
	<div class="divCell">
		<form method="post" action="https://www.siteguarding.com/en/services/malware-removal-service">
		<input type="submit" name="submit" id="submit" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_CLEAN_SITE'); ?>">
		</form>
	</div>
	</div>
    
    
	<div class="divRow"><div class="divCell">&nbsp;</div><div class="divCell"></div><div class="divCell"></div><div class="divCell"></div></div>
	
	<div class="divRow">
	<div class="divCell avpextraoption_txt"><?php echo JText::_('COM_JANTIVIRUS_MSG_SELECT_PACKAGE'); ?></div>
	<div class="divCell">
		<form method="post" action="https://www.siteguarding.com/en/protect-your-website">
			<input type="submit" name="submit" id="submit" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_PROTECT_SITE'); ?>">
		</form>
	</div>
	</div>
	
    
	<div class="divRow"><div class="divCell">&nbsp;</div><div class="divCell"></div><div class="divCell"></div><div class="divCell"></div></div>
	
	<div class="divRow">
	<div class="divCell avpextraoption_txt"><?php echo JText::_('COM_JANTIVIRUS_MSG_ANALYZE_FOR_FREE'); ?></div>
	<div class="divCell">
		<form method="post" action="index.php">
		<?php
		if ($license_info['membership'] == 'pro') 
		{
			?>
			<input type="submit" name="submit" id="submit" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_SENT_FOR_ANALYZE'); ?>">
			<?php
		} else {
			?>
			<input type="button" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_SENT_FOR_ANALYZE'); ?>" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_MSG_AVAILABLE_IN_PRO'); ?>');">
			<?php
		}
		?>	
		
			<input type="hidden" name="action" value="SendFilesForAnalyze"/>
			<input type="hidden" name="option" value="com_jantivirus"/>
			<input type="hidden" name="view" value="scanner"/>
		</form>
	</div>
	</div>
	
	<div class="divRow"><div class="divCell">&nbsp;</div><div class="divCell"></div><div class="divCell"></div><div class="divCell"></div></div>
	
	<div class="divRow">
	<div class="divCell avpextraoption_txt"><?php echo JText::_('COM_JANTIVIRUS_MSG_REMOVE_ONE_CLICK'); ?><br><span class="label_error"><?php echo JText::_('COM_JANTIVIRUS_MSG_NOTE_HACKER_CAN_INJECT'); ?></span></div>
	<div class="divCell">
		<form method="post" action="index.php">
		<?php
		if ($license_info['membership'] == 'pro') 
		{
			?>
			<input type="submit" name="submit" id="submit" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_REMOVE_MALWARE'); ?>">
			<?php
		} else {
			?>
			<input type="button" class="ui button" value="<?php echo JText::_('COM_JANTIVIRUS_BTTN_REMOVE_MALWARE'); ?>" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_MSG_AVAILABLE_IN_PRO'); ?>');">
			<?php
		}
		?>	
		
				<input type="hidden" name="action" value="QuarantineFiles"/>
				<input type="hidden" name="option" value="com_jantivirus"/>
				<input type="hidden" name="view" value="scanner"/>
		</form>
	</div>
	</div>
	

	</div>
	
	


			<?php
			if ($license_info['membership'] == 'free') 
			{
				?>
				<br />
				<span class="msg_box msg_error"><?php echo JText::_('COM_JANTIVIRUS_QUARANTINE_SERVICE'); ?> <a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain=<?php echo urlencode( JURI::root() ); ?>&email=<?php echo urlencode($license_info['email']); ?>" target="_blank"><?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?></a></span>
				<br />
				<br />
				<?php	
			}
			?>
			
<?php
if ( $license_info['last_scan_files_counters']['main'] > 0 || $license_info['last_scan_files_counters']['heuristic'] > 0 )
{
	?>
    <h3 class="ui dividing header"><?php echo JText::_('COM_JANTIVIRUS_TITLE_LATEST_RESULT'); ?></h3>
	<?php
}

			if (count($license_info['last_scan_files']['main']))
			{
				// Check files
				foreach ($license_info['last_scan_files']['main'] as $k => $tmp_file)
				{
					if (!file_exists(JPATH_SITE.'/'.$tmp_file)) unset($license_info['last_scan_files']['main'][$k]);
				}
				
				if (count($license_info['last_scan_files']['main']) > 0)
				{
					?>
					<div class="avp_latestfiles_block">
					<h4 class="label_error"><?php echo JText::_('COM_JANTIVIRUS_ACTION_REQUIRED'); ?></h4>
					
					<?php
					foreach ($license_info['last_scan_files']['main'] as $tmp_file)
					{
						echo '<p>'.$tmp_file.'</p>';
					}
					?>
	
					
					<table>
						<tr>
						<td>
					
						<form method="post" action="index.php">
						<?php
						if ($license_info['membership'] == 'pro') 
						{
							?>
							<input type="submit" name="submit" id="submit" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_QUARANTINE'); ?>">
							<?php
						} else {
							?>
							<input type="button" class="mini ui button" value="" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?>');">
							&nbsp;[<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain=<?php echo urlencode( JURI::root() ); ?>&email=<?php echo urlencode($license_info['email']); ?>" target="_blank"><?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?></a>]
							<?php
						}
						?>
						<input type="hidden" name="action" value="QuarantineFiles"/>
						<input type="hidden" name="file_type" value="main"/>
						<input type="hidden" name="option" value="com_jantivirus"/>
						<input type="hidden" name="view" value="scanner"/>
						</form>
						
						</td>
						<td>
						
						<form method="post" action="index.php">
						<?php
						if ($license_info['membership'] == 'pro') 
						{
							?>
							<input type="submit" name="submit" id="submit" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_SEND_FILES'); ?>">
							<?php
						} else {
							?>
							<input type="button" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_SEND_FILES'); ?>" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?>');">
							<?php
						}
						?>
						<input type="hidden" name="action" value="SendFilesForAnalyze"/>
						<input type="hidden" name="option" value="com_jantivirus"/>
						<input type="hidden" name="view" value="scanner"/>
						</form>
						
						</td>
						</tr>
					</table>
                    <p class="label_error">
					<?php echo JText::_('COM_JANTIVIRUS_MSG_NOTE_HACKER_CAN_INJECT'); ?>
                    </p>
					</div>
					<?php
				}

			}
			
			
			if (count($license_info['last_scan_files']['heuristic']))
			{
				// Check files
				foreach ($license_info['last_scan_files']['heuristic'] as $k => $tmp_file)
				{
					if (!file_exists(JPATH_SITE.'/'.$tmp_file)) unset($license_info['last_scan_files']['heuristic'][$k]);
				}
				
				if (count($license_info['last_scan_files']['heuristic']) > 0)
				{
					?>
					<div class="avp_latestfiles_block">
					<h4 class="label_error"><?php echo JText::_('COM_JANTIVIRUS_REVIEW_REQUIRED'); ?></h4>
					<?php
					foreach ($license_info['last_scan_files']['heuristic'] as $tmp_file)
					{
						echo '<p>'.$tmp_file.'</p>';
					}
					?>
					<br />
					
					<?php
					
					if ($license_info['whitelist_filters_enabled'] == 1)
					{
						?>
						<span class="msg_box msg_warning"><?php echo JText::_('COM_JANTIVIRUS_WHITE_LIST_ENABLED'); ?></span><br /><br />
						<?php
					}

					?>
					
					<table>
						<tr>
						<td>
					
						<form method="post" action="index.php">
						<?php
						if ($license_info['membership'] == 'pro') 
						{
							?>
							<input type="submit" name="submit" id="submit" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_QUARANTINE'); ?>">
							<?php
						} else {
							?>
							<input type="button" class="mini ui button" value="" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?>');">
							&nbsp;[<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <a href="https://www.siteguarding.com/en/buy-service/antivirus-site-protection?domain=<?php echo urlencode( JURI::root() ); ?>&email=<?php echo urlencode($license_info['email']); ?>" target="_blank"><?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?></a>]
							<?php
						}
						?>
						<input type="hidden" name="action" value="QuarantineFiles"/>
						<input type="hidden" name="file_type" value="heuristic"/>
						<input type="hidden" name="option" value="com_jantivirus"/>
						<input type="hidden" name="view" value="scanner"/>
						</form>
						
						</td>
						<td>
						
						<form method="post" action="index.php">
						<?php
						if ($license_info['membership'] == 'pro') 
						{
							?>
							<input type="submit" name="submit" id="submit" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_SEND_FILES'); ?>">
							<?php
						} else {
							?>
							<input type="button" class="mini ui button" value="<?php echo JText::_('COM_JANTIVIRUS_SEND_FILES'); ?>" onclick="javascript:alert('<?php echo JText::_('COM_JANTIVIRUS_AVAILABLE_IN_PRO_VERSION_ONLY'); ?> <?php echo JText::_('COM_JANTIVIRUS_PLEASE_UPGRADE'); ?>');">
							<?php
						}
						?>
						<input type="hidden" name="action" value="SendFilesForAnalyze"/>
						<input type="hidden" name="option" value="com_jantivirus"/>
						<input type="hidden" name="view" value="scanner"/>
						</form>
						
						</td>
						</tr>
					</table>
                    <p class="label_error">
					<?php echo JText::_('COM_JANTIVIRUS_MSG_NOTE_HACKER_CAN_INJECT'); ?>
					</p>
					</div>
					<?php
				}
			}
			
?>

<img class="imgpos" alt="Antivirus Website Protection" src="<?php echo '../media/com_jantivirus/images/mid_box.png'; ?>" width="110" height="70">
			
</div></div>

<p>
<a href="http://www.siteguarding.com/livechat/index.html" target="_blank">
	<img src="<?php echo '../media/com_jantivirus/images/livechat.png'; ?>"/>
</a><br />
<?php echo JText::_('COM_JANTIVIRUS_MSG_FOR_ANY_QUESTION_USE'); ?><br>
</p>

<p>
<?php echo JText::_('COM_JANTIVIRUS_POWERED_BY'); ?>
</p>

</div>

