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
 * ArcGIS World Imagery Map
 *
 * @link https://www.arcgis.com/home/item.html?id=10df2279f9684e4a9f6a7f08febac2a9
 */
class WorldImageryMap extends Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = 'World Imagery Map';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = 'wimagery';


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
    protected $tileUrl = 'http://services.arcgisonline.com/arcgis/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';

}
