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
 * Class for working with the ArcGIS World Street Map
 *
 * @link https://www.arcgis.com/home/item.html?id=3b93337983e9436f8db950e38a8629af
 */
class WStreetMap extends Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'World Street Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'wstreet';


    /**
     * Credits/attribution of the map publisher
     *
     * @var string
     */
    protected $attribution = 'ArcGIS';


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
    protected $maxZoom = 18;


    /**
     * A URL template used in getting map tile images
     *
     * @var string
     */
    protected $tileUrl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';

}
