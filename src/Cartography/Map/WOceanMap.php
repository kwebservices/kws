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
 * Class for working with the ArcGIS World Ocean Base Map
 *
 * @link https://www.arcgis.com/home/item.html?id=1e126e7520f9466c9ca28b8f28b5e500
 */
class WOceanMap extends Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'World Ocean Base Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'wocean';


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
    protected $tileUrl = 'http://services.arcgisonline.com/arcgis/rest/services/Ocean/World_Ocean_Base/MapServer/tile/{z}/{y}/{x}';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';

}
