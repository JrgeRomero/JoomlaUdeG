<?php
/**
 * @package	Antivirus
 * @copyright	Copyright (C) 2014 SiteGuarding.com. All rights reserved.
 * @license	GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');

$ajax_url = str_replace("/administrator/", "", JURI::base()).'/webanalyze/antivirus.php?cache='.time();
$ajax_index_url = str_replace("/administrator/", "", JURI::base()).'/index.php?cache='.time();
$session = JFactory::getSession();
$license_info = $session->get('jantivirus_license_info');

$session_report_key = md5(JURI::root().'-'.rand(1,100).'-'.time());

// analyze antivirus.php
$avp_any_file = JPATH_ROOT.'/webanalyze/antivirus.php';
$website_url = str_replace("/administrator/", "/", JURI::base());

if (!file_exists($avp_any_file))
{
    JError::raiseWarning( 100, 'Scanner module is absent.' );
    return;
}
if (class_exists('SGAntiVirus'))
{
    $a = SGAntiVirus::CheckAnyModule_status($website_url, $license_info['access_key']);
    if ($a !== true)
    {
        JError::raiseWarning( 100, $a );
        return;
    }
}
else {
    JError::raiseWarning( 100, 'Class SGAntiVirus is absent.' );
    return;
}

?>

        <script>
        	
            jQuery(document).ready(function(){
            	
            	var refreshIntervalId;
            	var link = "<?php echo $ajax_url; ?>";
	        	var show_report = 0;
	        	
	        	function ShowReport(data)
	        	{
	        		show_report = 0;
	        		
					jQuery("#progress_bar_process").css('width', '100%');
					jQuery("#progress_bar").hide();
					
					clearInterval(refreshIntervalId);
					
	                jQuery("#report_area").html(data);
	                jQuery("#back_bttn").show();
	                jQuery("#help_block").show();
	                jQuery("#rek_block").hide();
	        	}

				/*jQuery.post(link, {
					    task: "scan",
						access_key: "<?php echo $license_info['access_key']; ?>",
						session_report_key: "<?php echo $session_report_key; ?>",
						email: "<?php echo $license_info['email']; ?>"
					},
					function(data){
						ShowReport(data);
					}
				)
				.error(function() { 
   					GetReport();
				});*/
				
				function GetReport()
				{
					clearInterval(refreshIntervalId);
					
					jQuery.post('/index.php', {
						    option: "com_jantivirus",
						    action: "GetReport_AJAX",
							session_id: "<?php echo $_SESSION['scan']['session_id']; ?>",
							access_key: "<?php echo $license_info['access_key']; ?>",
							session_report_key: "<?php echo $session_report_key; ?>",
							domain: "<?php echo JURI::root(); ?>",
							email: "<?php echo $license_info['email']; ?>"
						},
						function(data){
							ShowReport(data);
						}
					);
				}
				
				
				function GetProgress()
				{
	               	var link = "<?php echo $ajax_index_url; ?>";
	
					jQuery.post(link, {
						    action: "scan_status",
							option: "com_jantivirus",
							access_key: "<?php echo $license_info['access_key']; ?>"
						},
						function(data){
						    var tmp_data = data.split('|');
						    if (tmp_data[0] > 90) {
				    			jQuery("#help_block").show();
				    			clearInterval(refreshIntervalId);
				    			refreshIntervalId =  setInterval(GetReport, 4500);
						    }
						    jQuery("#progress_bar_txt").html(tmp_data[0]+'% - '+tmp_data[1]);
						    jQuery("#progress_bar_process").css('width', parseInt(tmp_data[0])+'%');
						}
					);	
				}
				
				refreshIntervalId =  setInterval(GetProgress, 3000);
				
				
            });
        </script>
        
        
        
        <div id="progress_bar"><div id="progress_bar_process"></div><div id="progress_bar_txt"><?php echo JText::_('COM_JANTIVIRUS_TITLE_SCAN_STARTED'); ?></div></div>
        
        
		<p class="msg_box msg_info avp_reviewreport_block"><?php echo JText::_('COM_JANTIVIRUS_MSG_SCANNING_PROCESS_DESC'); ?><br /><a href="https://www.siteguarding.com/antivirus/viewreport?report_id=<?php echo $session_report_key; ?>" target="_blank">https://www.siteguarding.com/antivirus/viewreport?report_id=<?php echo $session_report_key; ?></a></p>
        
        
		<div id="report_area"></div>
        
        <div id="help_block" style="display: none;">

		<?php /*
		<a target="_blank" href="<?php echo JRoute::_('index.php?option=com_jantivirus&view=reports'); ?>"><?php echo JText::_('COM_JANTIVIRUS_SEE_REPORT_ONLINE'); ?></a><br /><br />
		*/ ?>
		<?php echo JText::_('COM_JANTIVIRUS_MSG_PROFESSIONAL_SECURITY'); ?>
		
		</div>
        
        <button id="back_bttn" style="display: none;" class="button" onclick="location.href='<?php echo JRoute::_('index.php?option=com_jantivirus'); ?>'"><?php echo JText::_('COM_JANTIVIRUS_BTTN_BACK'); ?></button>
        
        <div id="rek_block">
			<a href="https://www.siteguarding.com" target="_blank">
				<img class="effect7" src="<?php echo '../media/com_jantivirus/images/rek_scan.jpg'; ?>">
			</a>
		</div>
        
        <iframe style="width: 1px; height: 1px;border:0" src="<?php echo $ajax_index_url.'&option=com_jantivirus&action=scan&access_key='.$license_info['access_key'].'&session_report_key='.$session_report_key.'&email='.$license_info['email']; ?>"></iframe> 
