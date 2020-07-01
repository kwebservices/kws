<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Legacy\Cartography\Tile;


/**
 * Base class for all map tiles
 */
class Tile
{

    /**
     * X coordinate of the map tile
     *
     * @var int
     */
    protected $x = 0;


    /**
     * Y coordinate of the map tile
     *
     * @var int
     */
    protected $y = 0;


    /**
     * Zoom level of the map tile
     *
     * @var int
     */
    protected $zoom = 0;


    /**
     * Raw JPG or PNG map tile image
     *
     * @var string
     */
    protected $image = '';


    /**
     * Constructor for initalising new instances of this class
     * -------------------------------------------------------------------------
     * @param int       $x      Initial X coordinate of the map tile
     * @param int       $y      Initial Y coordinate of the map tile
     * @param int       $zoom   Initial zoom level of the map tile
     * @param string    $image  Initial map tile image
     */
    public function __construct(int $x = 0, int $y = 0, int $zoom = 0,
        string $image = '')
    {
        // Initialise some class properties
        $this->setX($x);
        $this->setY($y);
        $this->setZoom($zoom);
        $this->setImage($image);
    }


    /**
     * Set the X coordinate of the map tile
     * -------------------------------------------------------------------------
     * @param  int  $value  A new value
     *
     * @return \KWS\Cartography\Tile\Tile
     */
    public function setX(int $value) : Tile
    {
        $this->x = $value;
        return $this;
    }


    /**
     * Set the Y coordinate of the map tile
     * -------------------------------------------------------------------------
     * @param  int  $value  A new value
     *
     * @return \KWS\Cartography\Tile\Tile
     */
    public function setY(int $value) : Tile
    {
        $this->y = $value;
        return $this;
    }


    /**
     * Set the zoom level of the map tile
     * -------------------------------------------------------------------------
     * @param  int  $value  A new value
     *
     * @return \KWS\Cartography\Tile\Tile
     */
    public function setZoom(int $value) : Tile
    {
        $this->zoom = $value;
        return $this;
    }


    /**
     * Set the raw JPG or PNG map tile image
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value
     *
     * @return \KWS\Cartography\Tile\Tile
     */
    public function setImage(string $value) : Tile
    {
        $this->image = $value;
        return $this;
    }


    /**
     * Get the X coordinate of the map tile
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getX() : int
    {
        return $this->x;
    }


    /**
     * Get the Y coordinate of the map tile
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getY() : int
    {
        return $this->y;
    }


    /**
     * Get the zoom level of the map tile
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getZoom() : int
    {
        return $this->zoom;
    }


    /**
     * Get the raw JPG or PNG map tile image
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getImage() : string
    {
        return $this->image;
    }



}
