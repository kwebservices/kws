<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\DropshipZone;


/**
 * A Dropship Zone Product
 */
class Product
{

    /**
     * Holds the raw product data
     *
     * @var string[]
     */
    protected $data = [];



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param array     $data   Raw product data as an array
     */
    public function __construct(array $data)
    {
        // Initialise some class properties
        $this->data = $data;
    }


    /**
     * Get a single item from the raw product data
     * -------------------------------------------------------------------------
     * @param  string   $key        Key/column to get data from
     * @param  mixed    $default    Value to return iof no found
     * @param  string   $type       Type of data to return
     *
     * @return mixed|null
     */
    protected function get(string $key, $default = null, $type = 'string')
    {
        if (isset($this->data[$key])) {

            $result = $this->data[$key];

            switch ($type) {
                case 'int':
                    $result = preg_replace('|[^0-9.]|i','', $result);
                    $result = (int) $result;
                    break;

                case 'float':
                    $result = preg_replace('|[^0-9.]|i','', $result);
                    $result = (float) $result;
                    break;

                case 'bool':
                    $result = (bool) $result;
                    break;

                default:
                    $result = (string) $result;
                    break;
            }

            return $result;

        } else {
            return $default;
        }
    }


    /**
     * Get the product's SKU id
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getSku() : ?string
    {
        return $this->get('SKU', NULL, 'string');
    }


    /**
     * Get the product's category
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getCategory() : ?string
    {
        return $this->get('Category', NULL, 'string');
    }


    /**
     * Get the product's title
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getTitle() : ?string
    {
        return $this->get('Title', NULL, 'string');
    }


    /**
     * Get the product's stock qty
     * -------------------------------------------------------------------------
     * @return int|null
     */
    public function getQty() : ?int
    {
        return $this->get('Stock Qty', NULL, 'int');
    }


    /**
     * Get the product's status
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getStatus() : ?string
    {
        return $this->get('Status', NULL, 'string');
    }


    /**
     * Get the product's wholesale price
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getPrice() : ?float
    {
        return $this->get('price', NULL, 'float');
    }


    /**
     * Get the product's RRP price
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getRrp() : ?float
    {
        return $this->get('RrpPrice', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to VIC
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getVic() : ?float
    {
        return $this->get('VIC', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to NSW
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getNsw() : ?float
    {
        return $this->get('NSW', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to SA
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getSa() : ?float
    {
        return $this->get('SA', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to QLD
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getQld() : ?float
    {
        return $this->get('QLD', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to TAS
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getTas() : ?float
    {
        return $this->get('TAS', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to WA
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getWa() : ?float
    {
        return $this->get('WA', NULL, 'float');
    }


    /**
     * Get the fee for shipping the product to NT
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getNt() : ?float
    {
        return $this->get('NT', NULL, 'float');
    }


    /**
     * Get whether the product is classed as bulky
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getBulky() : ?string
    {
        return $this->get('bulky item', NULL, 'string');
    }


    /**
     * Get whether the product is discontinued
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getDiscontinued() : ?string
    {
        return $this->get('Discontinued', NULL, 'string');
    }


    /**
     * Get the product's EAN code
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getEan() : ?string
    {
        return $this->get('EAN Code', NULL, 'string');
    }


    /**
     * Get the product's brand
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getBrand() : ?string
    {
        return $this->get('Brand', NULL, 'string');
    }


    /**
     * Get the product's weight in Kgs
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getWeight() : ?float
    {
        return $this->get('Weight (kg)', NULL, 'float');
    }


    /**
     * Get the product's length in cm
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getLength() : ?float
    {
        return $this->get('Carton Length (cm)', NULL, 'float');
    }


    /**
     * Get the product's width in cm
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getWidth() : ?float
    {
        return $this->get('Carton Width (cm)', NULL, 'float');
    }


    /**
     * Get the product's height in cm
     * -------------------------------------------------------------------------
     * @return float|null
     */
    public function getHeight() : ?float
    {
        return $this->get('Carton Height (cm)', NULL, 'float');
    }


    /**
     * Get the product's description
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getDesc() : ?string
    {
        return $this->get('Description', NULL, 'string');
    }


    /**
     * Get the product's color
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getColor() : ?string
    {
        return $this->get('Color', NULL, 'string');
    }


    /**
     * Get a single product image
     * -------------------------------------------------------------------------
     * @param   int     $index  The index of the image to get
     *
     * @return string|null
     */
    public function getImage(int $index) : ?string
    {
        return $this->get("Image $index", NULL, "string");
    }


    /**
     * Get a list of URLs to product images
     * -------------------------------------------------------------------------
     * @return string[]
     */
    public function getImages() : array
    {
        $result = [];

        for ( $i=1 ; $i<=15 ; $i++ ) {

            $url = $this->getImage($i);

            if (!is_null($url)) {
                $result[] = $url;
            }

        }

        return $result;
    }


    /**
     * Download one of the product images
     * -------------------------------------------------------------------------
     * @param   int     $index  The array index of the image to download
     *
     * @return string
     */
    public function downloadImage(int $index) : string
    {
        return file_get_contents($this->getImage($index));
    }


}
