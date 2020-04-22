<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\TileSource;


/**
 * Tile Source for Thunderforest's Outdoors Map
 *
 * @link https://www.thunderforest.com/maps/outdoors/
 */
class OutdoorsTileSource extends TileSource
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'Outdoors Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'outdoors';


    /**
     * Minimum zoom level the map can handle
     *
     * @var int
     */
    protected $minZoom = 1;


    /**
     * Maximum zoom level the map can handle
     *
     * @var int
     */
    protected $maxZoom = 16;


    /**
     * A URL template used in getting map tile images
     *
     * @var string
     */
    protected $tileUrl = 'https://tile.thunderforest.com/outdoors/{z}/{x}/{y}.png?apikey={k}';

}
