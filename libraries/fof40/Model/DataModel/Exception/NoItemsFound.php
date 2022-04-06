<?php
/**
 * @package   FOF
 * @copyright Copyright (c)2010-2021 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 2, or later
 */

namespace  FOF40\Model\DataModel\Exception;

defined('_JEXEC') || die;

use Exception;
use Joomla\CMS\Language\Text;

class NoItemsFound extends BaseException
{
	public function __construct( $className, $code = 404, Exception $previous = null )
	{
		$message = Text::sprintf('LIB_FOF40_MODEL_ERR_NOITEMSFOUND', $className);

		parent::__construct( $message, $code, $previous );
	}

}
