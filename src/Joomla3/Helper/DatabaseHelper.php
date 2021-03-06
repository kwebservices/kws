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

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;


/**
 * Helper/untility class for working Joomla's database system
 */
class DatabaseHelper
{

    /**
     * Dumps a Joomla Database query with db table prefixes
     * ------------------------------------------------------------------------
     * @param  JDatabaseQuery   $query  The database query to dump
     * @param  bool             $die    Call die() after query has been dumped
     *
     * @return  void
     */
    public static function dumpQuery($query, bool $die = true) : void
    {
        echo Factory::getDbo()->replacePrefix((string) $query);
        if ($die) die();
    }


    /**
     * Format a MySQL datetime value into a more user friendly format
     * -------------------------------------------------------------------------
     * @param  string   $dateTime   The MySQL datetime value to format
     * @param  string   $format     The output format (optional)
     * @param  string   $default    Default value if date is '0'/invalid
     *
     * @return string   A more user friendly datetime string
     */
    public static function formatMysqlDateTime($dateTime, string
        $format = 'd/m/Y h:i:s A', string $default = '-')
    {
        // If the value is '0' or invalid the return the default
        if (empty($dateTime) OR ($dateTime == '0000-00-00 00:00:00')) {
            return $default;
        }

        // Get and return the new value
        return HTMLHelper::_('date', $dateTime, $format, true);
    }

}
