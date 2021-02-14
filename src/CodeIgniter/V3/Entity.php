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


class Entity
{
    
    /**
     * Database table to operate on
     *
     * @var string
     */
    protected $table = '';

    
    /**
     * Name of the database table's primary key
     *
     * @var string
     */
    protected $pk = 'id';

    
    /**
     * List fields in the database table
     *
     * @var string[]
     */
    protected $fields = [];

    
    /**
     * Values for all database fields
     *
     * @var mixed[]
     */
    protected $data = [];

    
    /**
     * Referance to Codeigniter's database object
     *
     * @var mixed
     */
    protected $db = null;


    
    /**
     * Construtor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function __construct()
    {
        // Initialise some local variables
        $CI = \get_instance();

        // Initialise some class properties        
        $this->db = $CI->db;
    }
    
        
    /**
     * Magic methood for setting field data
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the database field.
     * @param  mixed    $value  New value for the field
     * @return void
     */
    public function __set($name, $value)
    {        
        if (array_key_exists($name, $this->fields)) {
            if (is_null($value)) {
                unset($this->data[$name]);
            } else {
                $this->data[$name] = $value;
            }            
        }
    }

    
    /**
     * Magic methood for getting field data
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the database field.
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->data[$name] ?? null;
        }

        return null;
    }

    
    /**
     * Magic methood for checking if field data is set
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the database field.
     * @return mixed
     */
    public function __isset($name)
    {
         return isset($this->data[$name]);
    }

        
    /**
     * Magic methood for unsetting field data
     * ------------------------------------------------------------------------
     * @param  string   $name   Name of the database field.
     * @return void
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
    
               
    /**
     * Load data from database
     * -------------------------------------------------------------------------
     * @param  int  $id     ID of the table row
     * @return bool
     */
    public function load(int $id) : bool
    {      
        $this->db->reset_query();
        $result = $this->db->get_where($this->table, [$this->pk => $id]);

        if ($result->num_rows() == 0) {
            return false;
        }
        
        $this->clear();
        $this->fill($result->row());
        
        return true;
    }    

    
    /**
     * Save data to the database. If the current data contains a value for 
     * the primary key data will be updated. If not data will be inserted
     * -------------------------------------------------------------------------
     * @return void
     */
    public function save()
    { 
        if ($this->isNew()) {
            return $this->insert();
        } else {
            return $this->update();
        }        
    }

    
    /**
     * Insert the current data into the database table
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function insert() : bool
    {
        $this->db->reset_query();
        $this->db->insert($this->table, $this->data);

        if ($this->db->affected_rows() == 0) {
            return false;
        }

        $this->{$this->pk} = $this->db->insert_id();

        return true;
    }
    
    
    /**
     * Update the database with the current data
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function update() : bool
    {
        $this->db->reset_query();        
        $this->db->where($this->pk, $this->{$this->pk});
        $this->db->update($this->table, $this->data);

        if ($this->db->affected_rows() == 0) {
            return false;
        }

        return true;
    }

    
    /**
     * Reload current data from the database or clear all data.
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function reload()
    {
        return ($this->isNew()) ? $this->clear() : 
            $this->load($this->{$this->pk});
    }
    

    /**
     * Delete data from the database using primary key value
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function delete()
    {
        $this->db->reset_query();
        $this->db->where($this->pk, $this->{$this->pk});
        $this->db->delete($this->table);

        return $this->db->affected_rows() == 1;
    }
    

    /**
     * Fill/populate data in bulk
     * -------------------------------------------------------------------------
     * @param  mixed[]  $data   
     * @return void
     */
    public function fill($data)
    {       
        $data = (array) $data;       

        foreach ($this->fields as $field) {
            if (isset($data[$field])) {
                $this->$field = $data[$field];
            }                
        }
    }
    
    
    /**
     * Clear all data
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function clear() : bool
    {
        $this->data = [];
        return true;
    }

    
    /**
     * Check if the current data contains a value for the primary key
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function isNew() : bool
    {
        return empty($this->{$this->pk});
    }

}