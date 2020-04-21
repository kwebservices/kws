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
 * Base class for all maps
 */
class Map
{

    /**
     * A long form title for the map
     *
     * @var string
     */
    protected $title = ''


    /**
     * A short name/alias for the map
     *
     * @var string
     */
    protected $name = '';


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
    protected $tileUrl = '';


    /**
     * An API key used for getting map tiles/info
     *
     * @var string
     */
    protected $apikey = '';


    /**
     * Set the long form title for the map
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setTitle(string $value) : Map
    {
        $this->title = $value;
        return $this;
    }


    /**
     * Set the short name/alias for the map
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setName(string $value) : Map
    {
        $this->name = $value;
        return $this;
    }


    /**
     * Set the credits/attribution of the map publisher
     * -------------------------------------------------------------------------
     * @param  int   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setAttribution(int $value) : Map
    {
        $this->attribution = $value;
        return $this;
    }


    /**
     * Set the  minimum zoom level the map can handle
     * -------------------------------------------------------------------------
     * @param  int   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setMinZoom(int $value) : Map
    {
        $this->minZoom = $value;
        return $this;
    }


    /**
     * Set the  maximum zoom level the map can handle
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setMaxZoom(string $value) : Map
    {
        $this->maxZoom = $value;
        return $this;
    }


    /**
     * Set the URL template used in getting map tile images
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setTileUrl(string $value) : Map
    {
        $this->tileUrl = $value;
        return $this;
    }


    /**
     * Set the API key used for getting map tiles/info
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Map\Map
     */
    public function setApikey(string $value) : Map
    {
        $this->apikey = $value;
        return $this;
    }


    /**
     * Get the long form title for the map
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }


    /**
     * Get the short name/alias for the map
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }


    /**
     * Get the credits/attribution of the map publisher
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getAttribution() : string
    {
        return $this->attribution;
    }


    /**
     * Get the  minimum zoom level the map can handle
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMinZoom() : int
    {
        return $this->minZoom;
    }


    /**
     * Get the  maximum zoom level the map can handle
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMaxZoom() : int
    {
        return $this->maxZoom;
    }


    /**
     * Get the URL template used in getting map tile images
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTileUrl() : string
    {
        return $this->tileUrl;
    }


    /**
     * Get the API key used for getting map tiles/info
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getApikey() : string
    {
        return $this->apikey;
    }


    /**
     * Get a map tile image
     * -------------------------------------------------------------------------
     * @param  int    $x        X tile coordinate
     * @param  int    $y        Y tile coordinate
     * @param  int    $zoom     Zoom level
     *
     * @return string
     */
    public function getTile(int $x, int $y, int $zoom) : string
    {
        // Compose the tile image URL
        $url = $this->getTileUrl();
        $url = str_replace('{x}', $x , $url);
        $url = str_replace('{y}', $y , $url);
        $url = str_replace('{z}', $zoom , $url);
        $url = str_replace('{k}', $this->getApikey() , $url);

        // Try to download the tile image
        $client   = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        // Return the result
        return ($response->getStatusCode() == 200) $response->getBody() : '';
    }


}
