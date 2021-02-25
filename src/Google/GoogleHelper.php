<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Google;

use \GuzzleHttp\Client AS HttpClient;


/**
 * Helper class for working with various Google Services
 */
class GoogleHelper
{

    /**
     * Check if the current user agent is  googlebot
     *-------------------------------------------------------------------------
     * @return bool
     */
    public static function isGooglebot() : bool
    {
        return (bool) preg_match("/Google(bot)?/", $_SERVER['HTTP_USER_AGENT']);
    }
}
