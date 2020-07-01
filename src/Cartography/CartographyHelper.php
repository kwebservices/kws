<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography;


/**
 * Helper/utility class for working with cartography
 */
class CartographyHelper
{

    /**
     * Convert a  map tile's coordinates to lattitude-longitude coordinates
     * -------------------------------------------------------------------------
     * @param  int    $x    The map tile's x coordinate
     * @param  int    $y    The map tile's y coordinate
     * @param  int    $z    The map tile's z/zoom coordinate
     *
     * @return stdClass     An object containing the Lattitude and longitude
     *                      coordinates for (the top-left corner ?) of the tile.
     */
    public static function tileToLatlon(int $x, int $y, int $z)
    {
        // Initialise some local variables
        $result = new \stdClass;

        // Calculate the lat and lon for the given tile
        $n = pow(2, $z);
        $result->lon = $x / $n * 360.0 - 180.0;
        $result->lat = rad2deg(atan(sinh(pi() * (1 - 2 * $y / $n))));

        // Return the result
        return $result;
    }



    /**
     * Convert a lattitude, longitude and zoom level to map tile coordinates.
     * -------------------------------------------------------------------------
     * @param  float     $lat   Lattitude in decimal degrees (eg: -27.323232)
     * @param  float     $lon   Longitude in decimal degrees (eg: 159.292822)
     * @param  int       $zoom  Map zoom level (eg: 12)
     *
     * @return stdClass     An object containing x,y and z tile coordinates.
     */
    public static function latlonToTile(float $lat, float $lon, int $zoom)
    {
        // Initlise some local variables
        $result = new \stdClass;

        // Calculate the tile's x coordinate
        $result->x = floor((($lon + 180) / 360) * pow(2, $zoom));

        // Calculate the tile's y coordinate
        $result->y = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat)))
            / pi()) /2 * pow(2, $zoom));

        // Calculate the tile's z coordinate
        $result->z = $zoom;

        // Return the result
        return $result;
    }

}
