<?php
/**
 * @package    com_jocoaching
 * @author    Jl tryoen http://www.jltryoen.fr
 * @copyright  Copyright (C) 2007 - 2015 Jl tryoen  All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();
use Joomla\CMS\Factory;
use JLTRY\Lib\Helper\JLTRYHelper;

abstract class JHTMLTime
{
	public static function render ($dateValue, $id, $name, $options = array())
	{
		JLTRYHelper::loadLibrary(array(
				'jquery' => true,
				'timepicker' => true
		));
		$timeFormat =  'H:i:s';
		if (isset($options['timeFormat']) && ! empty($options['timeFormat']))
		{
			$timeFormat = $options['timeFormat'];
		}
		$timeClass = '';
		if (isset($options['timeclass']) && ! empty($options['timeclass']))
		{
			$timeClass = $options['timeclass'];
		}

		// Handle the special case for "now".
		$date = null;
		if (strtoupper($dateValue) == 'NOW')
		{
			$date = Factory::getDate();
			$date->setTime($date->format('H', true), 0, 0);
		}
		else if (strtoupper($dateValue) == '+1 HOUR' || strtoupper($dateValue) == '+2 MONTH')
		{
			$date = Factory::getDate();
			$date->setTime($date->format('H', true), 0, 0);
			$date->modify($dateValue);
		}
		else
		{
			$date = Factory::getDate($dateValue);
		}
		// Transform the date string.
		$timeString = $date->format($timeFormat, true);
		if ($options['allday'])
		{
			$timeString = $date->format($timeFormat, false);
		}
		$calCode = "jQuery(document).ready(function($){\n";
		$calCode .= " jQuery('#" . $id . "_time').timepicker({'timeFormat': '" . $timeFormat . "'});\n";
		$calCode .= "});\n";
		Factory::getDocument()->addScriptDeclaration($calCode);
		$options['class'] = 'input-small';
		$timeName = $name;
		if (strpos($timeName, ']') !== false)
		{
			$timeName = str_replace(']', '_time]', $name);
		}
		else
		{
			$timeName .= '_time';
		}
		$buffer = '&nbsp;<input type="text" class="time ' . $timeClass . '" value="' . $timeString . '" size="8" name="' . $timeName . '" id="' . $id .
				 '_time" ' . ($options['allday'] == '1' ? 'style="display:none"' : '') . '/>';
		return $buffer;
	}
}
