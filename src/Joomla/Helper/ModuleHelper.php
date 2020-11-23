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
   
    public $module = '';

 
    /**
     * Initialises new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed     $module     Module data
     */
    public function __construct($module)
    {
        // Initialise some class variables 
        $this->module         = $module;
        $this->module->params = new Registry($this->module->params);
   
    }


    /**
     * Get the database ID of the module
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
     * Get the name of the module, with/without the "mod_" prefix
     * -------------------------------------------------------------------------
     * @param  bool     $prefix     Include the "mod_" prefix
     * @return string
     */
    public function getName(bool $prefix = true) : string
    {
        return ($prefix) ? $this->module->module : $this->module->name;
    }

    
    /**
     * Get the position the module should be displayed at
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPosition() : string
    {
        return $this->module->position;
    }


    /**
     * Gets the value of a given module parameter
     * -------------------------------------------------------------------------
     * @param  string   $path       Registry path (e.g view.articles.show)       
     * @param  mixed    $default    Default value if not found
     * @return mixed
     */
    public function getParam(string $path, $default = null)
    {
        return $this->module->params->get($path, $default);
    }

        
    /**
     * Get the name of the module layout to render
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getLayout() : string
    {
        return $this->getParam('layout', 'default');
    }


    /**
     * Get a file path for a given module layout
     * -------------------------------------------------------------------------
     * @param  string   $layout     Name of a layout belonging to the module
     *
     * @return string
     */
    public function getLayoutPath($layout = null) : string
    {
        $layout = (empty($layout)) ? $this->getLayout() : $layout ;
        return JModuleHelper::getLayoutPath($this->getName(), $layout);
    }


    /**
     * Get the html tag type to use for the module's container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerTag() : string
    {
        return $this->getParam('module_tag', 'div');
    }


    /**
     * Get the CSS ID to use for the module's container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerId() : string
    {
        $result = $this->getParam('module_id');
        $result = (empty($result)) ? 'module-' . $this->getId() : result;       
        return $result;
    }


    /**
     * Get an css classes, typically used on the module container element
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getContainerClasses()
    {
        $result   = [];
        
        $result[] = $this->getName();
        
        $result[] = $this->getName() . '_' . 
            preg_replace('/^.*:/', '', $this->getLayout());
        
        $result[] = $this->getParam('module_classes', '');

        $result   = implode(' ', array_filter($result));

        return $result;
    }
  

    /**
	 * Get data as an object for rendering the module layout
	 * -------------------------------------------------------------------------
	 * @return \stdClass
	 *
	 * @deprecated
	 */
	public function getData()
	{
		return $this->params->toObject();
	}

}
