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

use \KWS\Helper\CartographyHelper;
use \KWS\Cartography\Tile\Tile;
use \GuzzleHttp\Client AS HttpClient;


/**
 * Base class for all maps
 */
class Map
{

    /**
     * A long form title for the tile source
     *
     * @var string
     */
    protected $title = '';


    /**
     * A short name/alias for the tile source
     *
     * @var string
     */
    protected $name = '';

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
    protected $tileUrl = '';


    /**
     * An API key used for accessing the tile source
     *
     * @var string
     */
    protected $apikey = '';



    /**
     * Factory method for creating new maps
     * -------------------------------------------------------------------------
     * @param  string   $type   Class prefix for the type of map to create
     *
     * @return \KWS\Cartography\Map\Map;
     */
    public static function create(string $type)
    {
        $className = $type . 'Map';
        if (class_exists($className)) {
            return new $className();
        }
    }


    /**
     * Set the long form title for the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return void
     */
    public function setTitle(string $value) : void
    {
        $this->title = $value;
    }


    /**
     * Set the short name/alias for the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return void
     */
    public function setName(string $value) : void
    {
        $this->name = $value;
    }


    /**
     * Set the  minimum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @param  int   $value  A new value
     *
     * @return void
     */
    public function setMinZoom(int $value) : void
    {
        $this->minZoom = $value;
    }


    /**
     * Set the  maximum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return void
     */
    public function setMaxZoom(string $value) : void
    {
        $this->maxZoom = $value;
    }


    /**
     * Set the URL template used in getting tile images
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return void
     */
    public function setTileUrl(string $value) : void
    {
        $this->tileUrl = $value;
    }


    /**
     * Set the API key used for accessing the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return void
     */
    public function setApikey(string $value) : void
    {
        $this->apikey = $value;
    }


    /**
     * Get the long form title for the tile source
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }


    /**
     * Get the short name/alias for the tile source
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Get the  minimum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMinZoom() : int
    {
        return $this->minZoom;
    }


    /**
     * Get the  maximum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMaxZoom() : int
    {
        return $this->maxZoom;
    }


    /**
     * Get the URL template used in getting tile images
     * -------------------------------------------------------------------------
     * @param   bool    $resolve    Resolve/replace all url tokens
     *
     * @return string
     */
    public function getTileUrl(bool $resolve = false) : string
    {
        // Get the tile template url
        $result = $this->tileUrl;

        // Resolve/replace all tokens
        if ($resolve) {
            $result = str_replace('{x}', $x , $result);
            $result = str_replace('{y}', $y , $result);
            $result = str_replace('{z}', $zoom , $result);
            $result = str_replace('{k}', $this->getApikey() , $result);
        }

        // Return the result
        return $result;
    }


    /**
     * Get the API key used for accessing the tile source
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getApikey() : string
    {
        return $this->apikey;
    }


    /**
     * Get a map tile image. Returns false on failure
     * -------------------------------------------------------------------------
     * @param  int    $x        X tile coordinate
     * @param  int    $y        Y tile coordinate
     * @param  int    $zoom     Zoom level
     *
     * @return \KWS\Cartography\Tile\Tile|bool
     */
    public function getTile(int $x, int $y, int $zoom)
    {
        // Download the tile image
        $client   = new HttpClient();
        $response = $client->get($this->getTileUrl(true));

        // Return the result
        return ($response->getStatusCode() == 200) ?
            new Tile($x, $y, $zoom, $response->getBody()) : false;
    }


    /**
     * Get the map tile image from a given lat/lon position
     * -------------------------------------------------------------------------
     * @param  float  $lat      Lattitude in decimal degrees (eg: -27.323232)
     * @param  float  $lon      Longitude in decimal degrees (eg: 159.292822)
     * @param  int    $zoom     Map zoom level (eg: 12)
     *
     * @return \KWS\Cartography\Tile\Tile|bool
     */
    public function getTilebyLatlon(float $lat, float $lon, int $zoom)
    {
        $coordinates = CartographyHelper::latlonToTile($lat, $lon, $zoom);
        return $this->getTile($coordinates->x, $coordinates->y, $coordinates->z);
    }

}
