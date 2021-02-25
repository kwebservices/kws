<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Helper;

use Joomla\Registry\Registry;
use Joomla\CMS\Helper\ModuleHelper AS JModuleHelper;


/**
 * Base class for creating module helpers.
 */
class ModuleHelper
{           
        
    /**
     * Copy of original module data
     *
     * @var undefined
     */
    protected $module = null;
                
         
   
    /**
     * Initialises new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed     $module     Module data
     */
    public function __construct($module)
    {
        // Initialise some class variables    
        $this->module = $module;      
        $this->module->params = new Registry($this->module->params);           
    }

           
    /**
     * Get the ID of the module in the database
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getId() : int
    {
        return $this->module->id;
    }

        
    /**
     * Get the title that has been given to the module
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTitle() : string
    {
        return $this->module->title;
    }

    
    /**
     * Get the name of the module, with/without a "mod_" prefix
     * -------------------------------------------------------------------------
     * @param  bool $prefix     Prefix the modules name with "mod_"
     * @return string
     */
    public function getName(bool $prefix = true) : string
    {
        return ($prefix) ? $this->module->module : $this->module->name;
    }

    
    /**
     * Get the template position the module is to be shown
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPosition(): string
    {
        return $this->module->position;
    }

    
    /**
     * Get the value of a given module parameter
     * -------------------------------------------------------------------------
     * @param  string   $path       Registry path (eg: 'logo.large.show')
     * @param  mixed    $default    Value to rerutrn if not found
     * @return mixed
     */
    public function getParam(string $path, $default = null)
    {
        return $this->module->params->get($path, $default);
    }

        
    /**
     * Get the name of the layout to be rendered
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getLayout() : string
    {
        return $this->getParam('layout','default');
    }


    /**
     * Get a file path to a module's layout file.
     * -------------------------------------------------------------------------
     * @param  string   $layout     Name of the module's layout 
     * @return string
     */
    public function getLayoutPath(string $layout = null) : string
    {
        $layout = (empty($layout)) ? $this->getLayout() : $layout;
        return JModuleHelper::getLayoutPath($this->getName(), $layout);
    }


    /**
     * Get a HTML tag name for the module's container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerTag() : string
    {
        return $this->getParam('module_tag','div');
    }

        
    /**
     * Get a CSS ID for the module's container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerId() : string
    {
        return 'module-' . $this->getId();
    }

        
    /**
     * Get some CSS classes for the module's container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerClass(): string
    {        
        $result     = [];
        $result[]   = $this->getName();
        $result[]   = $this->getName() . '_' . $this->getLayout();
        $result     = implode(' ', $result);

        return $result;
    }

}
