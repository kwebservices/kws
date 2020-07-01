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
 * Thunderforest's Transport Map
 *
 * @link https://www.thunderforest.com/maps/transport/
 */
class TransportMap extends Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = 'Transport Map';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = 'transport';


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
    protected $tileUrl = 'https://tile.thunderforest.com/transport/{z}/{x}/{y}.png?apikey={k}';

}
