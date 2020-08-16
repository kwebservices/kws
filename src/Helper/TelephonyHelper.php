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
 * Helper class for working with telephone/mobile data
 */
class TelephonyHelper extends Helper
{

    /**
     * Convert all phone words to digits
     * -------------------------------------------------------------------------
     * @param  string   $value  A number containing phone words
     *
     * @return string
     */
    public static function phoneWordtoDigits(string $value) : string
    {
        // Replace all phone letters with numbers
        $result = preg_replace('|[abc]|i','2', $value);
        $result = preg_replace('|[def]|i','3', $result);
        $result = preg_replace('|[ghi]|i','4', $result);
        $result = preg_replace('|[jkl]|i','5', $result);
        $result = preg_replace('|[mno]|i','6', $result);
        $result = preg_replace('|[pqrs]|i','7', $result);
        $result = preg_replace('|[tuv]|i','8', $result);
        $result = preg_replace('|[wxyz]|i','9', $result);

        // Return the result
        return $result;
    }


    /**
     * Check if a given number contains phone words
     * -------------------------------------------------------------------------
     * @param  string   $value  A telephone number
     *
     * @return bool
     */
    public static function hasPhoneWords(string $value) : bool
    {
        return preg_match('|[a-z#*]|i', $value);
    }


    /**
     * Extracts all phone words from ta number. Each phone word needs to be
     * seperated by at least 1 digit or whitespace charictar
     * -------------------------------------------------------------------------
     * @param  string   $value  Number to extract phone words from
     *
     * @return string[]
     */
    public static function extractPhoneWords(string $value)
    {
        $result = array();
        preg_match_all("|[a-z]+|i", $value, $result);
        return $result[0] ?? array();
    }

}
