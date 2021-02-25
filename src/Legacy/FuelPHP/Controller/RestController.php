<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Legacy\FuelPHP\Controller;


/**
 * Base class for creating REST controllers in FuelPHP
 */
class RestController extends \Controller_Rest
{

    /**
     * Holds the default output format
     *
     * @var string
     */
    protected $format = 'json';


    /**
     * Get a list of items
     * -------------------------------------------------------------------------
     * @return \Response
     */
    public function get_list()
    {
    }


    /**
     * Create a new item
     * -------------------------------------------------------------------------
     * @return \Response
     */
    public function post_create()
    {
    }


    /**
     * Get a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function get_read($id)
    {
    }


    /**
     * Update a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function put_update($id)
    {
    }


    /**
     * Delete a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function delete_delete($id)
    {
    }

}
