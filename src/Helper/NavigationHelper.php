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
 * Helper class for working with geospacial navigation
 */
class NavigationHelper
{

    protected static $cardinalDirections = ['N','NNE','NE','ENE','E','ESE',
        'SE','SSE','S','SSW','SW','WSW','W','WNW','NW','NNW', 'N'];


    /**
     * Convert an Azimuth (a bearing in decimal degrees) to the nearest
     * cardinal direction (based on a 16 point compass).
     * -------------------------------------------------------------------------
     * @param   float   $azimuth An azimuth between 0 and 360 degrees.
     *
     * @return  string  A cardinal direction (eg: NNE)
     */
    public static function azimuthToCardinalDirection(float $azimuth)
    {
        $index  = round(($azimuth % 360) / 22.5);
        $result = static::$cardinalDirections[$index];

        // Return the result
        return $result;
    }


    /**
     * Convert a cardinal direction to an Azimuth (a bearing in decimal degrees).
     * North ("N") will return 0. (based on a 16 point compass).
     * -------------------------------------------------------------------------
     * @param    string  $direction  A cardinal direction (eg: NNE)
     *
     * @return float|false   An azimuth (bearing in degrees), False
     *                       if direction is invalid
     */
    public static function cardinalDirectionToAzimuth(string $direction)
    {
        $index  = array_search($direction, static::$cardinalDirections);
        $result = ($index === false) ? false : $index * 22.5;

        // Return the reuslt
        return $result;
    }

}
