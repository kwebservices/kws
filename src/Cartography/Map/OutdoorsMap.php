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
 * Class for working with Thunderforest's Outdoors Map
 *
 * @link https://www.thunderforest.com/maps/outdoors/
 */
class OutdoorsMap extends Map
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
     * Credits/attribution of the map publisher
     *
     * @var string
     */
    protected $attribution = 'Thunderforest';


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


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '80ff0c99daa44c90a2367708e6fd34fc';

}
