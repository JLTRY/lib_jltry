<?php
/**
 * @package    dpcalendar
 * @author     JLTryoen http://www.jltryoen.fr
 * @copyright  Copyright (C) 2007 - 2015 JLTryoen . All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();
use Joomla\CMS\Factory;

use JLTRY\Lib\Helper\JLTRYHelper;


class JHTMLDatepair
{
	public static function render ($dateValue, $id, $name, $options = array())
	{
		JLTRYHelper::loadLibrary(array(
				'jQuery' => true,
				'datepair' => true,
				'moment' => true
		));
		
		if (isset($options['timepair']))
		{
			$calCode = "initdatepair(jQuery, \"" . $options['timepair'] . "\");";
        }
		Factory::getDocument()->addScriptDeclaration($calCode);
	}
}
