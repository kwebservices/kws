<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\Map;


/**
 * ArcGIS World Ocean Base Map
 *
 * @link https://www.arcgis.com/home/item.html?id=1e126e7520f9466c9ca28b8f28b5e500
 */
class WorldStreetMap extends Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = 'World Ocean Base Map';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = 'wocean';


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
    protected $maxZoom = 18;


    /**
     * A URL template used in getting tile images
     *
     * @var string
     */
    protected $tileUrl = 'http://services.arcgisonline.com/arcgis/rest/services/Ocean/World_Ocean_Base/MapServer/tile/{z}/{y}/{x}';

}
