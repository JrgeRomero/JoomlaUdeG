<?php
/**
 * @package	Antivirus
 * @copyright	Copyright (C) 2014 SiteGuarding.com. All rights reserved.
 * @license	GNU General Public License version 2 or later
 */
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>



	<table class="adminlist">
		<thead>
			<tr>
				<th width="130">
					<?php echo JText::_('COM_JANTIVIRUS_TITLE_REPORT_DATE'); ?>
				</th>
				<th>
					<?php echo JText::_('COM_JANTIVIRUS_TITLE_REPORT_DESC'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->reports as $report_info): ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td>
						<?php echo $report_info['date']; ?>
					</td>
					<td>
						<a href="<?php echo $report_info['report_link']; ?>" target="_blank"><?php echo JText::_('COM_JANTIVIRUS_MSG_CLICK_TO_VIEW'); ?><?php echo $report_info['domain']; ?>. <?php echo JText::_('COM_JANTIVIRUS_MSG_DATE'); ?><?php echo $report_info['date']; ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>




