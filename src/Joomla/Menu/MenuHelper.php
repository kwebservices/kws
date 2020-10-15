<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Menu;

use \Joomla\CMS\Factory;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;


/**
 * Helper/utility class for working with Joomla's menu system
 */
class MenuHelper
{

    /**
     * Get a list of menu items from a given menu
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the menu to get the items from
     *
     * @return array
     */
    public static function getMenuItems(string $name)
    {
        // Initialise some local variables
        $application = Factory::getApplication();
        $menu        = $application->getMenu();
        $default     = static::getDefault();
        $active      = static::getActive();
        $active      = (empty($active)) ? $default : $active;
        $result      = [];

        // Get the list of menu items
        $items = $menu->getItems('menutype', $name);

        // Process and add additional information to each item.
        foreach ($items as $k => $item) {

            // Perform additional processing if the item is of type 'alias'
            if ($item->type == 'alias') {
                $item->link = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                $item->route = Route::_($item->link);
            }

            // Perform additional processing if the item is of type 'url'
            if ($item->type == 'url') {
                $item->route = $item->link;
            }

            // Perform additional processing if the item is of type 'header'
            if ($item->type == 'header') {
                $item->route ='#';
            }

            // Perform additional processing if the item is of type 'separator'
            if ($item->type == 'separator') {
                $item->route ='#';
            }

            // Perform additional processing if the item is the default item.
            if ($item->default = $item->id == $default->id) {
                $item->route = '/';
            }

            // Add if the item is the currently active item or not
            $item->active = ($item->id == $active->id) ||
                ($item->params->get('aliasoptions') == $active->id);

            // Add the item to the list of results
            $result[$item->id] = $item;
        }

        // Return the result;
        return $result;
    }


    /**
     * Arrange a flat list of menu items into a hierarchy of menu item objects
     * -------------------------------------------------------------------------
     * @param  array    $items  A flat list of menu items
     *
     * @return  array   The same list of menu items arranged into a hierarchy
     */
    public static function createMenuItemHierarchy(array $items)
    {
        // Initialise some local variables
        $result = array();

        // Define a recusrsive ananonomous function for adding child items
        // to a menu item.
        $addChildren = function ($node, $items) use ( &$addChildren )
        {
            $result = $node;
            $result->children = [];

            foreach ($items as $item) {
                if ($item->parent_id == $result->id) {
                    $result->children[] = $item;
                }
            }

            if (!empty($result->children)) {
                foreach ($result->children as &$child) {
                    $child = $addChildren($child, $items);
                }
            }

            return $result;
        };

        // Recursively add all top level menu items
        foreach ($items as $item) {
            if (empty($item->parent_id) OR $item->parent_id == 1) {
                $result[] = $addChildren($item, $items);
            }
        }

        // Return the result;
        return $result;
    }


    /**
     *  Get the currently active menu item
     * -------------------------------------------------------------------------
     * @return  object  The currently active menu item
     */
    public static function getActive()
    {
        return Factory::getApplication()->getMenu()->getActive();
    }


    /**
     *  Get the default menu item
     * -------------------------------------------------------------------------
     * @return  object  The default menu item
     */
    public static function getDefault()
    {
        return Factory::getApplication()->getMenu()->getDefault();
    }


    /**
     * Add an item to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    Caption for the item
     * @param string    $view       View name to which the item will link to
     * @param string    $component  Component to which the item will link to
     *
     * @return  void
     */
    public static function addSidebarItem(string $caption, string $view,
        string $component) : void
    {
        // Prepare the sidebar item
        $link    = "index.php?option=com_$component&view=$view";
        $active  = Factory::getApplication()->input->get('view') == $view;

        // Add the item to the sidebar
        \JHtmlSidebar::addEntry(Text::_($caption), $link, $active);
    }


    /**
     * Add a heading to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    A caption for the heading
     * @param string    $tagName    A HTML tag name to enclose the title in
     *
     * @return  void
     */
    public static function addSidebarHeading(string $caption,
        string $headingTag = 'h4') : void
    {
        // Prepare the sidebar heading
        $heading = Text::_($caption);
        $heading = "<$headingTag>$heading</$headingTag>";

        // Add the heading to the sidebar
        \JHtmlSidebar::addEntry($heading);
    }


    /**
     * Renders the administration sidebar
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function renderSidebarMenu()
    {
        return \JHtmlSidebar::render();
    }


    /**
     * Get's an image for the menu item depending on the type of menu item
     * -------------------------------------------------------------------------
     * @param  \stdClass    $item   The menu item to find an image for
     *
     * @return string
     */
    public static function getMenuItemImage($item) : string
    {
        // Initialize some local variables
        $component = $item->component;
        $view      = $item->query['view'] ?? '';
        $id        = $item->query['id'] ?? '';
        $result    = $item->params->get('menu_image', '');

        switch ("$component.$view") {
            case 'com_content.category':
                $category = ContentHelper::getCategoryById($item->query['id']);
                $result   = $category->params->get('image');
                break;

            case 'com_content.article':
                $article = ContentHelper::getArticleById($id);
                $result  = $article->images['image_intro'];
                break;
        }

        // Return the result
        return $result;
    }

}
