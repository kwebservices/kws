<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\TileSource;

use \KWS\Cartography\Tile\Tile;
use \KWS\Cartography\TileCache\TileCache;


/**
 * Base class for all map tile sources
 */
class TileSource
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
     * Object for caching map tiles
     *
     * @var \KWS\Cartography\TileCache\TileCache
     */
    protected $cache = null;



    /**
     * Set the long form title for the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setTitle(string $value) : TileSource
    {
        $this->title = $value;
        return $this;
    }


    /**
     * Set the short name/alias for the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setName(string $value) : TileSource
    {
        $this->name = $value;
        return $this;
    }


    /**
     * Set the  minimum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @param  int   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setMinZoom(int $value) : TileSource
    {
        $this->minZoom = $value;
        return $this;
    }


    /**
     * Set the  maximum zoom level the tile source can handle
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setMaxZoom(string $value) : TileSource
    {
        $this->maxZoom = $value;
        return $this;
    }


    /**
     * Set the URL template used in getting tile images
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setTileUrl(string $value) : TileSource
    {
        $this->tileUrl = $value;
        return $this;
    }


    /**
     * Set the API key used for accessing the tile source
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setApikey(string $value) : TileSource
    {
        $this->apikey = $value;
        return $this;
    }


    /**
     * Set the object for caching map tiles
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\TileSource\TileSource
     */
    public function setCache(TileCache $value) : TileSource
    {
        $this->cache = $value;
        return $this;
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
     * Get the object for caching map tiles
     * -------------------------------------------------------------------------
     * @return \KWS\Cartography\TileCache\TileCache
     */
    public function getCache() : ?TileCache
    {
        return $this->cache;
    }


    /**
     * Get a map tile. Returns false on failure
     * -------------------------------------------------------------------------
     * @param  int    $x        X tile coordinate
     * @param  int    $y        Y tile coordinate
     * @param  int    $zoom     Zoom level
     *
     * @return \KWS\Cartography\Tile\Tile | bool
     */
    public function get(int $x, int $y, int $zoom)
    {
        // Download the tile image
        $client   = new \GuzzleHttp\Client();
        $response = $client->get($this->getTileUrl(true));

        // Return the result
        return ($response->getStatusCode() == 200) ?
            new Tile($x, $y, $zoom, $response->getBody()) : false;
    }

}
