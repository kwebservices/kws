<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\CodeIgniter\V4\Model;

use \Config\Database;


/**
 * Generic CodeIgniter Model
 */
class Model
{
    
    /**
     * Database connection
     *
     * @var CodeIgniter\Database\ConnectionInterface
     */
    protected $db;

        
    /**
     * Construtor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function __construct()
    {
        $this->db = Database::connect();
    }

}
