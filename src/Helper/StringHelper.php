<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Helper;


/**
 * Helper class for working with strings
 */
class StringHelper extends Helper
{


    /**
     * Remove all whitespace (spaces, tabs, etc) from a given string
     * -------------------------------------------------------------------------
     * @param  string   $str    String with whitespace charictars
     *
     * @return string
     */
    public static function removeWhitespace(string $str) : string
    {
        return preg_replace('/\s+/', '', $str);
    }


    /**
     * Remove all non ascii charictars from a given string
     * -------------------------------------------------------------------------
     * @param  string   $str    String with ascii charictars
     *
     * @return string
     */
    public static function removeNonAsciiChars(string $str) : string
    {
        return preg_replace('/[^[:ascii:]]/', '', $str);
    }


    /**
     * Remove all punctuation charictars (not whitespace, letters or numbers)
     * from a given string
     * -------------------------------------------------------------------------
     * @param  string   $str    String with punctuation charictars
     *
     * @return string
     */
    public static function removePunctuation(string $str) : string
    {
        return preg_replace('/[^[:punct:]]/', '', $str);
    }


    /**
     * Check if a given value contains HTML tags
     * -------------------------------------------------------------------------
     * @param  string   $str    String to check for HTML tags
     *
     * @return bool
     */
    public static function containsHTML(string $str) : bool
    {
        return $str != strip_tags($str);
    }


}
