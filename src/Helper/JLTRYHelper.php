<?php
/**
 * @package     JOCoaching
 * @subpackage  com_jocoaching
 * @author     JL Tryoen http://www.jltryoen.fr
 * @copyright   Copyright (C) 2011 - 2026 JL Tryoen, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace JLTRY\Lib\Helper;

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * JOCoaching component helper.
 *
 */
abstract class JLTRYHelper {
    public static function loadLibrary ($libraries = array())
    {
        $document = Factory::getDocument();
        //JOCoachingHelper::Log("loadLibrary" . print_r($libraries, true));
        /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
        $wa = $document->getWebAssetManager();
        $wr = $wa->getRegistry();
        $wr->addExtensionRegistryFile("lib_jltry");
        if (isset($libraries['jquery']))
        {
            HTMLHelper::_('jquery.framework');
        }
        if (isset($libraries['timepicker']))
        {
            $wa->useScript('jquery.timepicker');
            $wa->useStyle('jquery.timepicker');
        }
        if (isset($libraries['datepair']))
        {
            $wa->useScript('jquery.datepair');
            $wa->useScript('datepair');
        }
        if (isset($libraries['moment']))
        {
            $wa->useScript('moment');
        }
    }
}