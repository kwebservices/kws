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
 * Class for working with the Open Topo Map
 */
class OpenTopoMap extends Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'Open Topographic Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'otm';


    /**
     * Credits/attribution of the map publisher
     *
     * @var string
     */
    protected $attribution = '';


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
    protected $tileUrl = 'https://a.tile.opentopomap.org/{z}/{x}/{y}.png';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';

}
