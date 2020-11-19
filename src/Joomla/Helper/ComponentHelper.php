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

use \Joomla\CMS\Component\ComponentHelper AS JComponentHelper;
use \Joomla\CMS\MVC\Model\BaseDatabaseModel;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Table\Table;


/**
 * Helper/utility class for working with component extensions
 */
class ComponentHelper
{

    /**
     * Get a given component's global config. If no component name is provided
     * the current/active component will be used
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the component (eg: com_content)
     *
     * @return \stdClass
     */
    public static function getConfig(string $name = '')
    {
        // Make sure we have a component name
        if (empty($name)) {
            $name = Factory::getApplication()->input->get('option');
        }

        // Get the compontents global config
        $result = JComponentHelper::getParams($name)->toObject();

        // Return the result
        return $result;
    }


    /**
     * Get an instance of a component's model
     * -------------------------------------------------------------------------
     * @param  string   $component  Component the model belongs to (eg: com_content)
     * @param  string   $name       Name/suffix of the model (eg: Articles)
     * @param  string   $admin      Look in the component's back-end
     * @param  boolean  $config     Config to pass to the model's constructor
     *
     * @return mixed
     */
    public static function getModel(string $component, string $name,
        bool $admin = false, array $config = ['ignore_request' => true])
    {
        // Add the location of the model to the list of include paths
        $path   = ($admin) ? JPATH_ADMINISTRATOR : JPATH_SITE;
        $path  .= "/components/$component/models";
        $prefix = ucfirst(preg_replace('|^com_(.*)$|i', '$1Model' , $component));
        BaseDatabaseModel::addIncludePath($path, $prefix);

        // Get an instance of the given table
        $result = BaseDatabaseModel::getInstance($name, $prefix, $config);

        // Return the result
        return $result;

    }


    /**
     * Get an instance of a component table
     * -------------------------------------------------------------------------
     * @param  string   $component  Component the table belongs to (eg: com_content)
     * @param  string   $name       Name/suffix of the table (eg: Article)
     * @param  string   $admin      Look in the component's back-end
     * @param  boolean  $config     Config to pass to the table's constructor
     *
     * @return mixed
     */
    public static function getTable(string $component, string $name,
        bool $admin = false, array $config = [])
    {
        // Add the location of the table to the list of include paths
        $path   = ($admin) ? JPATH_ADMINISTRATOR : JPATH_SITE;
        $path  .= "/components/$component/tables";
        $prefix = ucfirst(preg_replace('|^com_(.*)$|i', '$1Table' , $component));
        Table::addIncludePath($path, $prefix);

        // Get an instance of the given table
        $result = Table::getInstance($name, $prefix, $config);

        // Return the result
        return $result;
    }


}
