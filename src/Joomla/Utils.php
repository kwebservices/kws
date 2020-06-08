<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla;

use \KWS\Joomla\Component\ComponentHelper;
use \KWS\Joomla\Database\DatabaseHelper;
use \KWS\Joomla\Menu\MenuHelper;
use \KWS\Joomla\User\UserHelper;
use \KWS\Joomla\ToolBar\ToolBarHelper;
use \KWS\Joomla\Document\DocumentHelper;


/**
 * Utility class for useful methods for working with Joomla
 */
class Utils
{


    /**
     * Get the component's global configuration. if no component nmae is given
     * then the name of the current/active component will be used.
     * -------------------------------------------------------------------------
     * @param   string  $name   Optional name of the component (eg: com_content)
     *
     * @return  stdClass
     *
     * @deprecated Use \KWS\Joomla\Helper\ComponentHelper::getConfig() instead.
     */
    public static function getComponentConfig(string $name = '')
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return ComponentHelper::getConfig($name);
    }


    /**
     * Get an instance of a component model
     * -------------------------------------------------------------------------
     * @param  string   $component  Component the model belongs to (eg: com_content)
     * @param  string   $name       Name/suffix of the model (eg: Articles)
     * @param  string   $admin      Look in the component's back-end
     * @param  boolean  $config     Config to pass to the model's constructor
     *
     * @return mixed
     *
     * @deprecated Use \KWS\Joomla\Helper\ComponentHelper::getModel() instead.
     */
    public static function getComponentModel(string $component, string $name,
        bool $admin = false, array $config = ['ignore_request' => true])
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return ComponentHelper::getModel($component, $name, $admin, $config);
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
     *
     * @deprecated Use \KWS\Joomla\Helper\ComponentHelper::getTable() instead.
     */
    public static function getComponentTable(string $component, string $name,
        bool $admin = false, array $config = [])
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return ComponentHelper::getTable($component, $name, $admin, $config);

    }


    /**
     * Dumps a Joomla Database query with db table prefixes
     * ------------------------------------------------------------------------
     * @param  JDatabaseQuery   $query  The database query to dump
     * @param  bool             $die    Call die() after query has been dumped
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\DatabaseHelper::dumpQuery() instead.
     */
    public static function dumpDatabaseQuery($query, bool $die = true) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        DatabaseHelper::dumpQuery($query, $die);
    }


    /**
     * Get a list of menu items from a given menu
     * -------------------------------------------------------------------------
     * @param  string   $menuType   Name of the menu to get the items from
     *
     * @return array    An array of menu item objects
     *
     * @deprecated Use \KWS\Joomla\Helper\MenuHelper::dumpQuery() instead.
     */
    public static function getMenuItems(string $name)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::getMenuItems($name);
    }


    /**
     * Arrange a flat list of menu items into a hierarchy of menu item objects
     * -------------------------------------------------------------------------
     * @param  array    $items  A flat list of menu items
     *
     * @return  array   The same list of menu items arranged into a hierarchy
     *
     * @deprecated Use \KWS\Joomla\Helper\MenuHelper::createMenuItemHierarchy() instead.
     */
    public static function createMenuItemHierarchy(array $items)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::createMenuItemHierarchy($items);
    }


    /**
     *  Get the currently active menu item
     * -------------------------------------------------------------------------
     * @return  object  The currently active menu item
     *
     * @deprecated Use \KWS\Joomla\Helper\MenuHelper::getActive() instead.
     */
    public static function getActiveMenuItem()
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::getActive();
    }


    /**
     * Add an item to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    Caption for the item
     * @param string    $view       View name to which the item will link to
     * @param string    $component  Component to which the item will link to
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\MenuHelper::addSidebarItem() instead.
     */
    public static function addSidebarItem(string $caption, string $view,
        string $component) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        MenuHelper::addSidebarItem($caption, $view, $component);
    }



    /**
     * Add a heading to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    A caption for the heading
     * @param string    $tagName    A HTML tag name to enclose the title in
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\MenuHelper::addSidebarHeading() instead.
     */
    public static function addSidebarHeading(string $caption,
        string $headingTag = 'h4') : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        MenuHelper::addSidebarHeading($caption, $headingTag);
    }


    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool
     *
     * @deprecated Use \KWS\Joomla\Helper\UserHelper::isAuthorised() instead.
     */
    public static function isAuthorised(string $action, string $asset,
        $userId = null)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        UserHelper::isAuthorised($action, $asset, $userId);
    }


    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string
     *
     * @deprecated Use \KWS\Joomla\Helper\UserHelper::isAuthorised() instead.
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        UserHelper::getFullName($userId, $default);
    }



    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\ToolbarHelper::setTitle() instead.
     */
    public static function setTitle(string $title) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::setTitle($title);
    }



    /**
     * Adds a standard set of toolbar items while editing an item
     * -------------------------------------------------------------------------
     * @param string    $component      Component the item controller belongs to
     * @param string    $controller     Controller to execute actions on
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\ToolbarHelper::addItemToolbarBtns() instead.
     */
    public static function addStandardItemToolbarBtns(string $component,
        string $controller) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addItemToolbarBtns($component, $controller);
    }


    /**
     * Adds a standard set of toolbar items while viewing a list of items
     * -------------------------------------------------------------------------
     * @param string    $component          Component the controllers belong to
     * @param string    $itemController     Controller for executing item actions
     * @param string    $listController     Controller for executing list actions
     *
     * @return  void
     *
     * @deprecated Use \KWS\Joomla\Helper\ToolbarHelper::addListToolbarBtns() instead.
     */
    public static function addStandardListToolbarBtns(string $component,
        string $itemController, string $itemController) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addListToolbarBtns($component, $itemController, $itemController);
    }


    /**
     * Add a global options button for this component to the
     * administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $component  Component to show the button for.
     *
     * @return void
     *
     * @deprecated Use \KWS\Joomla\Helper\ToolbarHelper::addOptionsBtn() instead.
     */
    public static function addOptionsToolbarBtn(string $component) : void
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addOptionsBtn($component);
    }


    /**
     * Format a MySQL datetime value into a more user friendly format
     * -------------------------------------------------------------------------
     * @param  string   $dateTime   The MySQL datetime value to format
     * @param  string   $format     The output format (optional)
     * @param  string   $default    Default value if date is '0'/invalid
     *
     * @return string   A more user friendly datetime string
     *
     * @deprecated Use \KWS\Joomla\Helper\DatabaseHelper::formatMysqlDateTime() instead.
     */
    public static function formatMysqlDateTime($dateTime, string
        $format = 'd/m/Y h:i:s A', string $default = '-')
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return DatabaseHelper::formatMysqlDateTime($dateTime, $format, $default);
    }



    /**
     * Get the current page title without a sitename prefix/suffix
     * -------------------------------------------------------------------------
     * @return string
     *
     * @deprecated Use \KWS\Joomla\Helper\DocumentHelper::getTitle() instead.
     */
    public static function getPageTitle()
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return DocumentHelper::getTitle();
    }

}
