<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Module;

use \Joomla\Registry\Registry;
use \Joomla\CMS\Helper\ModuleHelper AS JModuleHelper;


/**
 * Base class for creating module helpers.
 */
class ModuleHelper
{

    /**
     * ID of the module in the site's database
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
     * Name of the module (with mod_)
     *
     * @var string
     */
    public $module = '';

    /**
     * Position the module will be displayed at
     *
     * @var string
     */
    public $position = '';


    /**
     * Show/hide the module's title
     *
     * @var bool
     */
    public $showtitle = false;


    /**
     * Contains the bulk of the modules params/config
     *
     * @var \Joomla\Registry\Registry
     */
    public $params = null;


    /**
     * Name of the module (without mod_)
     *
     * @var string
     */
    public $name = '';


    /**
     * Module layout to be displayed
     *
     * @var string
     */
    public $layout = 'default';

    /**
     * HTML tag to use for the module container
     *
     * @var string
     */
    public $tag = 'div';


    /**
     * CSS ID for the module's container element
     *
     * @var string
     */
    public $cssId = '';


    /**
     * CSS class for the module's container element
     *
     * @var string
     */
    public $cssClass = '';



    /**
     * Initialises new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed     $module     Module data
     */
    public function __construct($module)
    {
        // Initialise some class variables
        $this->id        = $module->id;
        $this->title     = $module->title;
        $this->module    = $module->module;
        $this->position  = $module->position;
        $this->showtitle = $module->showtitle;
        $this->params    = new Registry($module->params);
        $this->name      = $module->name;
        $this->layout    = $this->params->get('layout', 'default');
        $this->tag       = $this->params->get('module_tag', 'div');
        $this->cssId     = "module-{$this->id}";
        $this->cssClass  = "{$this->module} {$this->module}_{$this->layout}";
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
        return JModuleHelper::getLayoutPath($this->module,
            $layout ?? $this->layout);
    }


}
