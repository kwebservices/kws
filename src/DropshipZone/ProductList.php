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


use \KWS\DropshipZone\Product;
use \League\Csv\Reader AS CsvReader;
use \ArrayAccess;
use \Iterator;


/**
 * A Dropship Zone Product List
 */
class ProductList implements ArrayAccess, Iterator
{

    /**
     * A listy of products
     *
     * @var \KWS\DropshipZone\Product[]
     */
    protected $items = [];


    /**
     * Checks if a product exists at a given offset
     * -------------------------------------------------------------------------
     * @param  mixed    $offset    An array offset
     *
     * @return bool
     */
    public function offsetExists($offset) : bool
    {
         return isset($this->items[$offset]);
    }


    /**
     * Get the product at the given offset
     * -------------------------------------------------------------------------
     * @param  mixed    $offset     An array offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }


    /**
     * Set a product at the given offset
     * -------------------------------------------------------------------------
     * @param mixed     $offset     An array offset
     * @param mixed     $value      Product data as an array or product object
     *
     * @return void
     */
    public function offsetSet($offset , $value)
    {
        // Make sure we have a Product object
        if (is_array($value)) {
            $value = new Product($value);
        }

        // Update the list of items
        $this->items[$offset] = $value;
    }


    /**
     * Unset a product at given offset
     * -------------------------------------------------------------------------
     * @param mixed $offset     An array offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }


    /**
     * Get the product at the current internal product list pointer
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function current()
    {
        return current($this->myArray);
    }


    /**
     * Get the index at the current internal product list pointer
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function key()
    {
        return key($this->myArray);
    }


    /**
     * Advance the internal product list pointer to the next product
     * -------------------------------------------------------------------------
     * @return void
     */
    public function next() : void
    {
        next($this->myArray);
    }


    /**
     * Set the internal product list pointer to the first product
     * -------------------------------------------------------------------------
     * @return void
     */
    public function rewind() : void
    {
        reset($this->myArray);
    }


    /**
     * Check that a product with a given index exists and is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function valid () : bool
    {
        return key($this->myArray) !== null;
    }


    /**
     * Load the product list from a dropshipzone SKU file
     * -------------------------------------------------------------------------
     * @param  string   $filename   Absolute path to the file
     *
     * @return void
     */
    public function loadFromFile(string $filename)
    {
        // Clear all existing items
        $this->items = [];

        // Parse the CSV data
        $csvReader = CsvReader::createFromPath($filename, 'r');
        $csvReader->setHeaderOffset(0);
        $items = iterator_to_array($csvReader->getRecords());

        // Add new products
        foreach ($items as $item) {
            $this->items[] = new Product($item);
        }
    }


}
