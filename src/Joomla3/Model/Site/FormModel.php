<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Model\Site;

use Joomla\CMS\MVC\Model\FormModel AS JFormModel;
use Joomla\CMS\Factory;


/**
 * Base class for creating generic front-end form models
 */
class FormModel extends JFormModel
{

    /**
     * Get a form for the model
     * -------------------------------------------------------------------------
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form
        $result  = $this->loadForm("{$this->option}.{}$this->name}",
            $this->name, ['control' => 'jform', 'load_data' => $loadData]);

        // Return the result
        return $result;
    }


    /**
     * Load the data that should be injected in the form
     * -------------------------------------------------------------------------
     */
    protected function loadFormData()
    {
        // Get the form data from the current user state (the user's session)
        $result = Factory::getApplication()->getUserState(
            "{$this->option}.edit.{$this->name}.data", 'jform', [], 'array');

        // Return the result
        return $result;
    }

}
