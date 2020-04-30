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
     * Get the product's SKU id
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getSku() : string
    {
        return $this->data['SKU'] ?? '';
    }


    /**
     * Get the product's category
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getCategory() : string
    {
        return $this->data['Category'] ?? '';
    }


    /**
     * Get the product's title
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTitle() : string
    {
        return $this->data['Title'] ?? '';
    }


    /**
     * Get the product's stock qty
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getQty() : string
    {
        return $this->data['Stock Qty'] ?? '';
    }


    /**
     * Get the product's status
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getStatus() : string
    {
        return $this->data['Status'] ?? '';
    }


    /**
     * Get the product's wholesale price
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPrice() : string
    {
        return $this->data['price'] ?? '';
    }


    /**
     * Get the product's RRP price
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getRrp() : string
    {
        return $this->data['RrpPrice'] ?? '';
    }


    /**
     * Get the fee for shipping the product to VIC
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getVic() : string
    {
        return $this->data['VIC'] ?? '';
    }


    /**
     * Get the fee for shipping the product to NSW
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getNsw() : string
    {
        return $this->data['NSW'] ?? '';
    }


    /**
     * Get the fee for shipping the product to SA
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getSa() : string
    {
        return $this->data['SA'] ?? '';
    }


    /**
     * Get the fee for shipping the product to QLD
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getQld() : string
    {
        return $this->data['QLD'] ?? '';
    }


    /**
     * Get the fee for shipping the product to TAS
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTas() : string
    {
        return $this->data['TAS'] ?? '';
    }


    /**
     * Get the fee for shipping the product to WA
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getWa() : string
    {
        return $this->data['WA'] ?? '';
    }


    /**
     * [getNt description]
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getNt() : string
    {
        return $this->data['NT'] ?? '';
    }


    /**
     * Get whether the product is classed as bulky
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBulky() : string
    {
        return $this->data['bulky item'] ?? '';
    }


    /**
     * Get whether the product is discontinued
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDiscontinued() : string
    {
        return $this->data['Discontinued'] ?? '';
    }


    /**
     * Get the product's EAN code
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getEan() : string
    {
        return $this->data['EAN Code'] ?? '';
    }


    /**
     * Get the product's brand
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBrand() : string
    {
        return $this->data['Brand'] ?? '';
    }


    /**
     * Get the product's weight in Kgs
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getWeight() : string
    {
        return $this->data['Weight (kg)'] ?? '';
    }


    /**
     * Get the product's length in cm
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getLength() : string
    {
        return $this->data['Carton Length (cm)'] ?? '';
    }


    /**
     * Get the product's width in cm
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getWidth() : string
    {
        return $this->data['Carton Width (cm)'] ?? '';
    }


    /**
     * Get the product's height in cm
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getHeight() : string
    {
        return $this->data['Carton Height (cm)'] ?? '';
    }


    /**
     * Get the product's description
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDesc() : string
    {
        return $this->data['Description'] ?? '';
    }


    /**
     * Get the product's color
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getColor() : string
    {
        return $this->data['Color'] ?? '';
    }


    /**
     * Get a list of URLs to product images
     * -------------------------------------------------------------------------
     * @return string[]
     */
    public function getImages() : array
    {
        $result = [];

        for ( $i=1 ; $i<=15 ; $i+) {

            $url = $this->data["Image $i"] ?? '';

            if (!empty($url)) {
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
        return file_get_contents($this->data["Image $index"]);
    }


}
