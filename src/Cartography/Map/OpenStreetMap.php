<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\Map;


/**
 * Open Street Map
 */
class OpenStreetMap extends Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = 'Open Street Map';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = 'osm';


    /**
     * Minimum zoom level the tile source can handle
     *
     * @var int
     */
    protected $minZoom = 1;


    /**
     * Maximum zoom level the tile source can handle
     *
     * @var int
     */
    protected $maxZoom = 16;


    /**
     * A URL template used in getting tile images
     *
     * @var string
     */
    protected $tileUrl = '	https://a.tile.openstreetmap.org/${z}/${x}/${y}.png';

}
