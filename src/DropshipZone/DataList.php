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

use \ArrayAccess;
use \Iterator;
use \Countable;


/**
 * Base class for holding/processing a list of dropship zone items
 */
class DataList implements ArrayAccess, Iterator, Countable
{

    /**
     * A list of items
     *
     * @var \KWS\DropshipZone\DataItem[]
     */
    protected $items = [];


    /**
     * Checks if an item exists at a given offset
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
     * Get the item at the given offset
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
     * Set a item at the given offset
     * -------------------------------------------------------------------------
     * @param mixed     $offset     An array offset
     * @param DataItem  $value      Item
     *
     * @return void
     */
    public function offsetSet($offset , DataItem $value)
    {
        $this->items[$offset] = $value;
    }


    /**
     * Unset a item at given offset
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
     * Get the item at the current internal product list pointer
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function current()
    {
        return current($this->items);
    }


    /**
     * Get the index at the current internal item list pointer
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function key()
    {
        return key($this->items);
    }


    /**
     * Advance the internal product list pointer to the next item
     * -------------------------------------------------------------------------
     * @return void
     */
    public function next() : void
    {
        next($this->items);
    }


    /**
     * Set the internal item list pointer to the first product
     * -------------------------------------------------------------------------
     * @return void
     */
    public function rewind() : void
    {
        reset($this->items);
    }


    /**
     * Check that a item with a given index exists and is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function valid () : bool
    {
        return key($this->items) !== null;
    }


    /**
     * Get the total number of items in the list
     * -------------------------------------------------------------------------
     * @return int
     */
    public function count() : int
    {
        return count($this->items);
    }


}
