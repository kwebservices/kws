<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\Map;


/**
 * Queensland Topographic Map
 *
 * @link http://qtopo.dnrm.qld.gov.au/Mobile/
 */
class QtopoMap extends Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = 'QLD Topographic Map';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = 'qtopo';


    /**
     * Minimum zoom level the tile source can handle
     *
     * @var int
     */
    protected $minZoom = 4;


    /**
     * Maximum zoom level the tile source can handle
     *
     * @var int
     */
    protected $maxZoom = 15;


    /**
     * A URL template used in getting tile images
     *
     * @var string
     */
    protected $tileUrl = 'https://gisservices2.information.qld.gov.au/arcgis/rest/services/QTopo/QTopoBase_WebM/MapServer/tile/{z}/{y}/{x}';

}
