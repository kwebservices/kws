<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Helper;


/**
 * Helper class for PHP debuging
 */
class DebugHelper extends Helper
{

    /**
     * Enable all PHP error reporting
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function enableFullErrorReporting() : void
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    /**
     * Disable all PHP error reporting
     * -------------------------------------------------------------------------
     * @return void
     */
    public function disableAllErrorReporting() : void
    {
        error_reporting(E_NONE);
        ini_set('display_errors', 0);
    }

}
