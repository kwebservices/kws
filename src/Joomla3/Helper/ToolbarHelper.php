<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Helper;

use Joomla\CMS\Toolbar\ToolbarHelper AS JToolBarHelper;
use Joomla\CMS\Language\Text;


/**
 * Helper/utility class for working Joomla's toolbar system
 */
class ToolbarHelper
{

    /**
     * Add a create/new button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addCreateBtn(string $component, string $controller)
    {
         if (UserHelper::isAuthorised('core.create', $component)) {
             JToolBarHelper::addNew("{$controller}.add");
         }
    }


    /**
     * Add an edit button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addEditBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit', $component)) {
            JToolBarHelper::editList("{$controller}.edit");
        }
    }


    /**
     * Add a publish button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addPublishBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit.state', $component)) {
            JToolBarHelper::publish("{$controller}.publish");
        }
    }


    /**
     * Add a unpublish button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addUnpublishBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit.state', $component)) {
            JToolBarHelper::unpublish("{$controller}.unpublish");
        }
    }


    /**
     * Add a delete button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addDeleteBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.delete', $component)) {
            JToolBarHelper::deleteList("", "{$controller}.delete");
        }
    }


    /**
     * Add a apply button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addApplyBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit', $component)) {
            JToolBarHelper::apply("{$controller}.apply");
        }
    }


    /**
     * Add a save button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addSaveBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit', $component)) {
            JToolBarHelper::save("{$controller}.save");
        }
    }


    /**
     * Add a Save and New button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addSave2NewBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit', $component) AND
            UserHelper::isAuthorised('core.create', $component)) {

            JToolBarHelper::save2new("{$controller}.save2new");
        }
    }


    /**
     * Add a Cancel button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return void
     */
    public static function addCancelBtn(string $component, string $controller)
    {
        JToolBarHelper::cancel("{$controller}.cancel");
    }


    /**
     * Add a component options button to the toolbar
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     *
     * @return void
     */
    public static function addOptionsBtn(string $component)
    {
        if (UserHelper::isAuthorised('core.admin', $component)) {
            JToolBarHelper::preferences($component);
        }
    }


    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     *
     * @return  void
     */
    public static function setTitle(string $title) : void
    {
        JToolBarHelper::title(Text::_($title));
    }


    /**
     * Adds a standard set of toolbar items while editing an item
     * -------------------------------------------------------------------------
     * @param string    $component     A component name
     * @param string    $controller    A component controller name
     *
     * @return  void
     */
    public static function addItemToolbarBtns(string $component,
        string $controller) : void
    {
        static::addApplyBtn($component, $controller);
        static::addSaveBtn($component, $controller);
        static::addSave2NewBtn($component, $controller);
        static::addCancelBtn($component, $controller);
    }


    /**
     * Adds a standard set of toolbar items while viewing a list of items
     * -------------------------------------------------------------------------
     * @param string    $component          A component name
     * @param string    $itemController     Controller name for item actions
     * @param string    $listController     Controller name for list actions
     *
     * @return  void
     */
    public static function addListToolbarBtns(string $component,
        string $itemController, string $listController) : void
    {
        static::addCreateBtn($component, $itemController);
        static::addEditBtn($component, $itemController);
        static::addPublishBtn($component, $listController);
        static::addUnpublishBtn($component, $listController);
        static::addDeleteBtn($component, $listController);
        static::addOptionsBtn($component);
    }


}
