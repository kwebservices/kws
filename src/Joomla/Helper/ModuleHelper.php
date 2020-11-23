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
     * Copy of the original module data.
     *
     * @var \stdClass
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


}
