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
		
		$calCode = "jQuery(document).ready(function(){\n";
		
		if (isset($options['timepair']))
		{
			$calCode .= "var MOMENTDATEFORMAT = 'YYYY-MM-DD' ;
					var MOMENTTIMEFORMAT = 'HH:mm:ss' ;
					jQuery('." . $options['timepair'] .
					 "').datepair({'dateClass': 'date', 'startClass': 'start', 'endClass': 'end', 'setMinTime': null,
					  parseTime: function(input){
							// use moment.js to parse time
							var m = moment(input.value, MOMENTTIMEFORMAT);
							return m.toDate();
						},
						updateTime: function(input, dateObj){
							var m = moment(dateObj);
							input.value = m.format(MOMENTTIMEFORMAT);
					   },
						parseDate: function(input){
						   var m = moment(input.value, MOMENTDATEFORMAT);
							return m.toDate();
						},
						updateDate: function(input, dateObj){
							var m = moment(dateObj);
							input.value = m.format(MOMENTDATEFORMAT);
							input.innerHTML = input.value;
						},
						setMinTime: null
						 });\n";
				 
		}
		$calCode .= "});\n";
		Factory::getDocument()->addScriptDeclaration($calCode);
	}
}
