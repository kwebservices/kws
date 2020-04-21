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
 * Class for working with the ArcGIS World Topographic Map
 *
 * @link https://www.arcgis.com/home/item.html?id=30e5fe3149c34df1ba922e6f5bbf808f
 */
class WTopoMap extends Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = 'World Topographic Map';


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = 'wtopo';


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
    protected $tileUrl = 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';

}
