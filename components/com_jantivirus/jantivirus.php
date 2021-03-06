<?php
/**
 * @package	Antivirus
 * @copyright	Copyright (C) 2014 SiteGuarding.com. All rights reserved.
 * @license	GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted access');
 
define( 'SITEGUARDING_SERVER_IP1', '185.72.157.169');
define( 'SITEGUARDING_SERVER_IP2', '185.72.157.170');

if (!defined('DIRSEP'))
{
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') define(DIRSEP, '\\');
	else define(DIRSEP, '/');
}

require_once( JPATH_SITE.DIRSEP."administrator".DIRSEP."components".DIRSEP."com_jantivirus".DIRSEP."classes".DIRSEP."sgantivirus.class.php");

$action = JRequest::getVar('action', '');


switch ($action)
{
	// index.php?option=com_jantivirus&action=scan
	case 'scan':
		$access_key = JRequest::getVar('access_key', '');
		$session_report_key = JRequest::getVar('session_report_key', '');
		$email = JRequest::getVar('email', '');
		$_REQUEST['task'] = 'scan';
		include_once( JPATH_SITE.DIRSEP."webanalyze".DIRSEP."antivirus.php");
		break;
		
	// index.php?option=com_jantivirus&action=scan_status
	case 'scan_status':
		$access_key = JRequest::getVar('access_key', '');
		$_REQUEST['task'] = 'scan_status';
		include_once( JPATH_SITE.DIRSEP."webanalyze".DIRSEP."antivirus.php");
		break;
		
	case 'GetReport_AJAX':
		for ($i = 0; $i <= 20; $i++)
		{
			sleep(5);
			$report = SGAntiVirus_module::getReport(JRequest::getVar('domain', ''), JRequest::getVar('access_key', ''), JRequest::getVar('session_report_key', ''));
			if ($report !== false ) 
			{
				echo $report;
				break;
			}
		}
		break;
		
	case 'StartScan_AJAX':
		SGAntiVirus_module::scan();
		break;	
		
	case 'GetScanProgress_AJAX':
		echo SGAntiVirus_module::readProgress();
		break;
		
	case 'status':
		// Check license info
		$params = JComponentHelper::getParams('com_jantivirus'); 
		if (trim($params->get('access_key')) == '') exit;
		else {
			$license_info = SGAntiVirus::GetLicenseInfo(JURI::root(), $params->get('access_key'));
			if ($license_info === false) exit;
			
			$access_key = JRequest::getVar('access_key', '');
			if ($access_key != $license_info['access_key']) exit;

			$a = array(
				'status' => 'ok',
				'answer' => md5(JRequest::getVar('answer', '')),
				'platform' => 'Joomla',
				'version' => SGAntiVirus::$antivirus_version
			);
			
			echo json_encode($a);
		}
		break;
		
		
	case 'get_malware_files':
	
		// Check license info
		$params = JComponentHelper::getParams('com_jantivirus'); 
		if (trim($params->get('access_key')) == '') exit;
		else {
			$license_info = SGAntiVirus::GetLicenseInfo(JURI::root(), $params->get('access_key'));
			if ($license_info === false) exit;
			
			$access_key = JRequest::getVar('access_key', '');
			if ($access_key != $license_info['access_key']) exit;

			
			$a = SGAntiVirus::SendFilesForAnalyze( $access_key, $license_info['email'] );
			if ($a === true)
			{
				$tmp_txt = 'Files sent for analyze. You will get report by email '.$license_info['email'];
				
				$result_txt = array(
					'status' => 'OK',
					'description' => $tmp_txt
				);
				SGAntiVirus_module::DebugLog($tmp_txt);
			}
			else {
				$tmp_txt = 'Operation is failed. Nothing sent for analyze.';
				
				$result_txt = array(
					'status' => 'ERROR',
					'description' => $tmp_txt
				);
				SGAntiVirus_module::DebugLog($tmp_txt);
			}
			
			echo json_encode($result_txt);
			
		}
		break;
		
		
		
		
	case 'remove_malware_files':
		// Check license info
		$params = JComponentHelper::getParams('com_jantivirus'); 
		if (trim($params->get('access_key')) == '') exit;
		else {
			$license_info = SGAntiVirus::GetLicenseInfo(JURI::root(), $params->get('access_key'));
			if ($license_info === false) exit;
			
			$access_key = JRequest::getVar('access_key', '');
			if ($access_key != $license_info['access_key']) exit;

			
			$a = SGAntiVirus::QuarantineFiles($license_info['last_scan_files']['main']);
			if ($a === true)
			{
				$result_mgs = 'Malware moved to quarantine and deleted from the server. Files:'.print_r( $license_info['last_scan_files'],true);
				SGAntiVirus_module::DebugLog( $result_mgs );
				echo $result_mgs;
			}
			else {
				$result_mgs = 'Operation is failed. Some files are not moved to quarantine or not deleted. Files:'.print_r( $license_info['last_scan_files'],true);
				SGAntiVirus_module::DebugLog( $result_mgs );
				echo $result_mgs;
			}
			
			$a = SGAntiVirus::QuarantineFiles($license_info['last_scan_files']['heuristic']);
			if ($a === true)
			{
				$result_mgs = 'Malware moved to quarantine and deleted from the server. Files:'.print_r( $license_info['last_scan_files'],true);
				SGAntiVirus_module::DebugLog( $result_mgs );
				echo $result_mgs;
			}
			else {
				$result_mgs = 'Operation is failed. Some files are not moved to quarantine or not deleted. Files:'.print_r( $license_info['last_scan_files'],true);
				SGAntiVirus_module::DebugLog( $result_mgs );
				echo $result_mgs;
			}
			
			exit;
		}
		break;
		
		
		
	case 'view_file':
		// Check license info
		$params = JComponentHelper::getParams('com_jantivirus'); 
		if (trim($params->get('access_key')) == '') exit;
		else {
			$license_info = SGAntiVirus::GetLicenseInfo(JURI::root(), $params->get('access_key'));
			if ($license_info === false)  {echo 'access_key is not correct'; exit;}
			
			if ($_SERVER["REMOTE_ADDR"] == SITEGUARDING_SERVER_IP1 || $_SERVER["REMOTE_ADDR"] == SITEGUARDING_SERVER_IP2)
			{
				$filename = $_GET['file'];
				
				$mainframe = JFactory::getApplication();
				$tmp_path = $mainframe->getCfg('tmp_path');
				
				switch ($filename)
				{
					case 'debug':
						$filename = $tmp_path.DIRSEP.'antivirus_debug.log';
						break;
						
					case 'filelist':
						$filename = $tmp_path.DIRSEP.'filelist.txt';
						break;
						
					default:
						$filename = JPATH_ROOT.DIRSEP.$filename;
				}
				
				echo "\n\n";
				
				if (file_exists($filename)) echo 'File exists: '.$filename."\n";
				else {echo 'File is absent: '.$filename."\n\n"; exit;}
				
				echo 'File size: '.filesize($filename)."\n";
				echo 'File MD5: '.strtoupper(md5_file($filename))."\n\n";
				
				$handle = fopen($filename, "r");
				$contents = fread($handle, filesize($filename));
				fclose($handle);
				echo '----- File Content [start] -----'."\n";
				echo $contents;
				echo '----- File Content [end] -----'."\n";
			}
			else {echo 'IP is not correct'; exit;}
			
			exit;
		}
		break;
		
		
	case 'cron':
		// Check license info
		$params = JComponentHelper::getParams('com_jantivirus'); 
		if (trim($params->get('access_key')) == '') exit;
		else {
			$license_info = SGAntiVirus::GetLicenseInfo(JURI::root(), $params->get('access_key'));
			if ($license_info === false) exit;
			
			$access_key = JRequest::getVar('access_key', '');
			if ($access_key != $license_info['access_key']) exit;

			
			$_POST['scan_path'] = JPATH_SITE;
			$_POST['access_key'] = $access_key;
			$_POST['do_evristic'] = 1;
			$_POST['domain'] = JURI::root();
			$_POST['email'] = $license_info['email'];
			$_POST['session_report_key'] = md5(JURI::root().'-'.rand(1,1000).'-'.time());
			
			SGAntiVirus_module::scan(false, false);
		}
		break;
}


exit;

?>
