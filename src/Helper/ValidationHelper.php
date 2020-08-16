<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Helper;


/**
 * Helper class that can used to validate various types of data
 */
class ValidationHelper extends Helper
{

    /**
     * Checks if a given value is a hexidecimal color value. Matches values
     * with/without a precceding hash. Matches 3 digit, 6 digit and 8 digit
     * color values ( eg: #FFF, #FFFFFF, #FFFFFFAA ).
     * -------------------------------------------------------------------------
     * @param   mixed   $value         The value to test
     *
     * @return  bool    True if the value is a hexidecimal number, False if not.
     */
    public static function isHexColor($value) : bool
    {
        $regex = "|^#?([0-9A-F]{3}|[0-9A-F]{6}|[0-9A-F]{8})$|i";
        return (bool) preg_match($regex, $value);
    }


    /**
     * Checks if a given value is a IPv4 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is a IPv4 address, False if not.
     */
    public static function isIPv4Address($value) : bool
    {
        return (bool) preg_match("|^([0-9]{1,3}\.){3}[0-9]{1,3}$|i", $value);
    }


    /**
     * Checks if a given value is a IPv6 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is a IPv6 address, False if not.
     */
    public static function isIPv6Address($value) : bool
    {
        return (bool) preg_match("|^([A-F0-9]{1,4}:){7}[A-F0-9]{1,4}$|i", $value);
    }


    /**
     * Checks if a given value is a IPv4 or IPv6 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is an IPv4/IPv6 address, False if not.
     */
    public static function isIPAddress($value) : bool
    {
        return static::isIPv4Address($value) || static::isIPv6Address($value);
    }


    /**
     * Checks if a given value is a valid day pf the week. Matches day
     * number (0 - 6) and various abbreviations.
     * -------------------------------------------------------------------------
     * @param   mixed   $value  The value to test
     *
     * @return  bool    True if a valid day of the week, False if not.
     */
    public static function isDayOfWeek($value) : bool
    {
        $regex = "^(?:mo(?:n(?:day)?)?|tu(?:e(?:s(?:day)?)?)?|" .
            "we(?:d(?:nsday)?)?|th(?:u(?:rs(?:day)?)?)?|fr(?:i(?:day)?)?|" .
            "sa(?:t(?:urday)?)?|su(?:n(?:day)?)?|[mtwfs0-6])$";

        return (bool) preg_match("#$regex#i", $value);
    }


    /**
     * Checks if a given value is gender.
     * -------------------------------------------------------------------------
     * @param  string   $value  The value to test
     *
     * @return bool     True if valid, False if not
     */
    public static function isGender(string $value) : bool
    {
        $rgex = '^(?:m(?:[ae]n|ale)?|boy|f(?:emale)?|wom[ae]n|girl)$';
        return  (bool) preg_match("#$regex#i", $value);
    }


    /**
     * Check if a given ip address is a private address. If no ip address
     * is given then the user's ip address will be used.
     * -------------------------------------------------------------------------
     * @param  string   $ip     An IP4 or IP6 address.
     *
     * @return bool
     */
    public static function isPrivateIPAddress(string $ip = '') : bool
    {
        // If no ip address was given, use the remote users ip
        $ip = (empty($ip)) ? $_SERVER['REMOTE_ADDR'] : $ip ;

        // Check if the given ip falls within private CDIRS
        $result = (bool) preg_match('#^(?:10|127)(?:\.\d{1,3}){3}$#', $ip) ||
            preg_match('#^(?:192\.168|172\.16)(?:\.\d{1,3}){2}$#', $ip);

        // Return the result
        return $result;
    }

}
