<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Model\Administrator;

use \Joomla\CMS\MVC\Model\ListModel AS JListModel;


/**
 * Base class for creating list based back-end models
 */
class ListModel extends JListModel
{

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
