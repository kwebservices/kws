<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\DropshipZone;


/**
 * Class that represents a dropship zone product update
 */
class Update extends DataItem
{
    
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
     * Get the product's title
     * -------------------------------------------------------------------------
     * @return string|null
     */
    public function getTitle() : ?string
    {
        return $this->get('Name', NULL, 'string');
    }


    /**
     * Get the product's stock qty
     * -------------------------------------------------------------------------
     * @return int|null
     */
    public function getQty() : ?int
    {
        return $this->get('QOH', NULL, 'int');
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
        return $this->get('Price', NULL, 'float');
    }


}
