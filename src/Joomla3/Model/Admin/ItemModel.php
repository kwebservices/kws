<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Model\Admin;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;


/**
 * Base class for creating item based back-end models
 */
class ItemModel extends AdminModel
{

    /**
     * Get a table object, load it if necessary.
     * -------------------------------------------------------------------------
     * @param  string 	$name   	The table name.
     * @param  string 	$prefix 	The class prefix.
     * @param  array  	$config 	Configuration array for table.
     * 
     * @return \Joomla\CMS\Table\Table
     */
    public function getTable($name = '', $prefix = '', $config = [])
    {       
        if (empty($prefix)) {
            $prefix = ucfirst(preg_replace('|com_(.*)|', 
                '$1Table', $this->option));
        }

        return parent::getTable($name, $prefix, $config);
    }


    /**
     * Get a form for the model
     * -------------------------------------------------------------------------
     * @param  array    $data       Data for the form.
     * @param  boolean  $loadData   True if the form is to load its
     *                                  own data (default case)
     *
     * @return Form    A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form
        $result = $this->loadForm($this->option . '.' . $this->name,
            $this->name, array('control' => 'jform', 'load_data' => $loadData));

        // Return the result
        return (empty($result)) ? false  : $result;
    }


    /**
     * Load the data that should be injected in the form
     * -------------------------------------------------------------------------
     * @return  array|boolean   Data to be injected into the form, or an empty
     *                          array to use default data.
     */
    protected function loadFormData()
    {
        // Initialise some local variables
        $application = Factory::getApplication();

        // Try to load the form data from the user state
        $result = $application->getUserState($this->option . '.edit.' .
            $this->name .'.data', array());

        // If no data was found,  try the getItem method
        $result = (empty($result)) ? $this->getItem() : $result;

        // Return the result
        return (empty($result)) ? false  : $result;
    }


}
