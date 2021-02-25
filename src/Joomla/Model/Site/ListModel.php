<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Model\Site;

use \Joomla\CMS\MVC\Model\ListModel AS JListModel;


/**
 * Base class for creating list based front-end models
 */
class ListModel extends JListModel
{
    
    /**
     * Get a JDatabaseQuery object for retrieving the dataset from database
     * -------------------------------------------------------------------------
     * @return \JDatabaseQuery  
     */
    protected function getListQuery()
    {
        // Initialise some local variables        
        $database = $this->getDbo();
        $query    = parent::getListQuery();

        // Add the order by clause
        $ordering   = $database->escape($this->getState('list.ordering'));
        $direction  = $database->escape($this->getState('list.direction'));
        if (!empty($ordering) and !empty($direction))
            $query->order($ordering . ' ' . $direction);

        // Return the result
        return $query;
    }


    /**
     * Get the current ordering column
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getOrdering()
    {
        return $this->state->get('list.ordering');
    }


    /**
     * Get the current ordering direction
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDirection()
    {
        return $this->state->get('list.direction');
    }

}
