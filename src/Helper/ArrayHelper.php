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
 * Helper class for working with arrays
 */
class ArrayHelper extends Helper
{

    /**
     * Convert an array to a string.
     * -------------------------------------------------------------------------
     * @param   array  $array          The array to convert.
     * @param   string $innerGlue      The glue between the key and the value.
     * @param   string $outerGlue      The glue between array elements.
     * @param   bool   $quoteChar      Charictar to surround the value with.
     * @param   bool   $finalGlue      Add the outerGlue to the last item
     *
     * @return  string
     */
     public static function toString(array $array, string
        $innerGlue = '=', string $outerGlue = ' ',
        string $quoteChar = '"', bool $finalGlue = true)
    {
        $output = array();

        foreach ($array as $key => $item) {

            if (\is_array($item)) {
                $output[] = static::toString($item, $innerGlue,
                    $outerGlue, $quoteChar, $finalGlue);
            } else {
                $output[] = $key . $innerGlue . $quoteChar .
                    $item . $quoteChar;
            }
        }

        $result  = implode($outerGlue, $output);
        $result .= ($finalGlue) ? $outerGlue  : '';

        return $result;
    }



    /**
     * Convert an associtive array into a CSS rule. Keys are treated as CSS
     * property names and values are treated as values for the corrasponding
     * property.
     * -------------------------------------------------------------------------
     * @param  string  $selector       A CSS selector for the CSS rule
     * @param  array   $properties     A list of CSS property => value pairs
     *
     * @return string
     */
    public static function toCSSRule(string $selector, array $properties) : string
    {
        $result  = $selector . ' { ';
        $result .= static::toString($properties, ': ', '; ', '');
        $result .= '}';

        // Return the result
        return $result;
    }



    /**
     * Find which array element contains the closest value to the one provided.
     * This method only works on arrays containing int or float values
     * -------------------------------------------------------------------------
     * @param  float         $value     The value to use
     * @param  float[]       $array     A list of float or int values
     *
     * @return int|string    The key of the element which is closest
     */
     public static function closest(float $value, array $array)
     {
         // Initlise some local variables
         $closest = null;

         // Find the element with the closest value
         foreach ($array as $key => $item) {

             if ($closest === null || abs($value - $closest) >
                 abs($item - $value)) {

                 $closest = $item;
                 $result  = $key;

             }
         }

         // Return the result
         return $result;
     }


     /**
      * Gets the average of a list of values
      * ------------------------------------------------------------------------
      * @param  array  $values   A list of values
      *
      * @return float
      */
     public function average(array $values)
     {
         $values = array_filter($values, function($x) { return $x !== ''; });
         return array_sum($values) / count($values);
     }

}
