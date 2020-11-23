<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Helper;

use \Joomla\Registry\Registry;
use \Joomla\CMS\Helper\ModuleHelper AS JModuleHelper;


/**
 * Base class for creating module helpers.
 */
class ModuleHelper extends Helper
{    
        
    /**
     * ID of the module in the database
     *
     * @var int
     */
    public $id = 0;
    

    /**
     * Title given to the module
     *
     * @var string
     */
    public $title = '';

        
    /**
     * Name of the module without "mod_" prefix
     *
     * @var string
     */
    public $name = '';

        
    /**
     * Position for the module to be rendered
     *
     * @var string
     */
    public $position = '';
        

    /**
     * Values for all the module's parameters
     *
     * @var undefined
     */
    public $params = null;

    
    /**
     * Layout to be rendered
     *
     * @var string
     */
    public $layout = '';

            
    /**
     * File path to the layout to be rendered
     *
     * @var string
     */
    public $layoutPath = '';


   
    /**
     * Initialises new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed     $module     Module data
     */
    public function __construct($module)
    {
        // Initialise some class variables    
        $this->id       = $module->id;
        $this->title    = $module->title;
        $this->name     = $module->name;
        $this->position = $module->position;
        $this->params   = new Registry($module->params);        
        $this->layout   = $this->params->get('layout', 'default');        

        $this->layoutPath = JModuleHelper::getLayoutPath(
            'mod_' . $this->name, $this->layout);
        
    }




}
