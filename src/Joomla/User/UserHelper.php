<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\User;

use \Joomla\CMS\Factory;


/**
 * Helper/utility class for working Joomla's user system
 */
class UserHelper
{

    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool
     */
    public static function isAuthorised(string $action, string $asset,
        $userId = null)
    {
        // Check if the user is authorised to perform the action on
        // the given asset and return the result
        return Factory::getUser($userId)->authorise($action, $asset);
    }


    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        // Get and return the user's name
        return (empty($userId)) ? $default : Factory::getUser($userId)->name;
    }

}
