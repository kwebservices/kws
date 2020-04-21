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
 * Class for working with the ArcGIS National Geographic Map
 *
 * @link https://www.arcgis.com/home/item.html?id=b9b1b422198944fbbd5250b3241691b6
 */
class NatGeoMap extends Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'National Geographic Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'natgeo';


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
    protected $maxZoom = 16;


    /**
     * A URL template used in getting map tile images
     *
     * @var string
     */
    protected $tileUrl = 'https://services.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';

}
