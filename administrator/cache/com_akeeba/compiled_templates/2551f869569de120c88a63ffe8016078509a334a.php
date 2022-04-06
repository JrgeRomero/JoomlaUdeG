<?php /* C:\wamp64\www\wdg2021\administrator\components\com_akeeba\tmpl\ControlPanel\warning_phpversion.blade.php */ ?>
<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2021 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @var $this \Akeeba\Backup\Admin\View\ControlPanel\Html */

// Protect from unauthorized access
defined('_JEXEC') || die();

use FOF40\Date\Date;

?>
<?php /* Old PHP version reminder */ ?>
<?php echo $this->loadAnyTemplate('admin:com_akeeba/CommonTemplates/phpversion_warning', [
    'softwareName'  => 'Akeeba Backup',
    'minPHPVersion' => '7.2.0',
]); ?>
