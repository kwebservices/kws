<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Helper;

use Joomla\CMS\HTML\HTMLHelper;


/**
 * Helper/untility class for working dates and times
 */
class DateTimeHelper
{

    /**
	 * Converts a MySQL datetime value into a more user friendly format
	 * -------------------------------------------------------------------------
	 * @param  string $dateTime 	The MySQL datetime value to convert
	 * @param  string $format       The output format
	 * @param  string $default      Value to return if the date is '0'/invalid 
     * 
	 * @return string 
	 */
    public static function mysqlDateTimeToStr($dateTime, $format = 
        'd/m/Y h:i:s A', $default = '-')
	{
		// If the value is '0' or invalid the return the default
		if (empty($dateTime) OR ($dateTime == '0000-00-00 00:00:00'))
			return $default;

		// Get and return the new value
		return HTMLHelper::_('date', $dateTime, $format, true);
    }
    
}