<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\CodeIgniter\V3;

use \CI_Model;


class Model extends CI_Model
{

    
    /**
     * Primary database table to operate on
     *
     * @var string
     */
    protected $table = '';

    
    /**
     * Nane of the database table's primary key
     *
     * @var string
     */
    protected $pk = 'id';

        
    /**
     * List of valid database table fields
     *
     * @var string[]
     */
    protected $fields = [];


    
    /**
     * Save an item to the database. If $item holds a value for the primary key 
     * then the item is updated. If not the a new item is created.
     * -------------------------------------------------------------------------
     * @param  mixed    $item   Item to be saved
     * @return bool
     */
    public function save($item)
    {
        if (isset($item[$this->pk])) {
            return $this->update($item);
        } else {
            return $this->cerate($item);
        }
    }

        
    /**
     * Create a new item. A value for the primary key will be ignored.
     * -------------------------------------------------------------------------
     * @param  mixed    $item   Item to be created
     * @return bool
     */
    public function create($item)
    {
        $item = $this->filter($item);
        unset($item[$this->pk]);        

        $this->db->reset_query();
        $this->db->insert($this->table, $item);

        return $this->db->affected_rows() == 1;
    }


    /**
     * Update an existing item. $item must hold a value for the primary key
     * -------------------------------------------------------------------------
     * @param  mixed    $item   Item to be updated
     * @return bool
     */
    public function update($item)
    {
        $item = $this->filter($item);
        $id   = $item[$this->pk] ?? false;

        if (is_null($id)) {
            return false;
        }

        $this->db->reset_query();
        $this->db->where($this->pk, $id);
        $this->db->update($this->table, $item);   

        return $this->db->affected_rows() == 1;
    }

        
    /**
     * Get an existing item
     * -------------------------------------------------------------------------
     * @param  int  $id     ID of the item to get
     * @return mixed
     */
    public function get(int $id)
    {
        $this->db->reset_query();
        $result = $this->db->get_where($this->table, [$this->pk => $id]);        
        return ($result->num_rows() > 0) ? $result->row() : false ;
    }


    /**
     * Get a list of existing items
     * -------------------------------------------------------------------------
     * @param  int  $id     ID of the item to get
     * @return mixed
     */
    public function list(string $ordercol = null, string $orderdir = 'asc', 
        int $start = 0, int $limit = 0)
    {
        // TO DO
    }

        
    /**
     * Delete an existing item
     * -------------------------------------------------------------------------
     * @param  int  $id     ID of the item to delete
     * @return bool
     */
    public function delete(int $id)
    {
        $this->db->reset_query();
        $this->db->where($this->pk, $id);
        $this->db->delete($this->table);

        return $this->db->affected_rows() == 1; 
    }

    
    /**
     * Filters out all extranious data fields
     * -------------------------------------------------------------------------
     * @param  mixed    $item   Item to be filtered
     * @return mixed
     */
    protected function filter($item)
    {
        return array_intersect_key($item, $this->fields); 
    }
    

}
