<?php
/**
 * @package     lib_jltry
 * @author     JL Tryoen http://www.jltryoen.fr
 * @copyright   Copyright (C) 2011 - 2026 JL Tryoen, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace JLTRY\Lib\Field;
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Form\Field\CalendarField;
use Joomla\CMS\Language\Text;



class DatetimeField extends CalendarField
{
	protected $type = 'Datetime';
	public function getInput ()
	{
		HTMLHelper::addIncludePath(dirname(__FILE__));
		$options = array();
		$options['timepair'] = $this->element['timepair'];
		$options['timeclass'] = $this->element['timeclass'] . " form-control";
		$options['allday'] = $this->element['allday'] == 1;
		$value = $this->value;
		$calendarrender = parent::getInput ();
		$timerender = '<div class="input-group">' .
					HTMLHelper::_('time.render', $value, $this->id, $this->name, $options) .
					'</div>';
		$datepairrender = HTMLHelper::_('datepair.render', $value, $this->id, $this->name, $options);
		return "<table><tr><td>".
				$calendarrender .
				"</td><td>" . 
				$timerender .
				$datepairrender .
				"</td></table>";
	}
}