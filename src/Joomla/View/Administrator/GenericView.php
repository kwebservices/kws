<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\View\Administrator;

use \KWS\Joomla\Component\ComponentHelper;
use \KWS\Joomla\Menu\MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;


/**
 * Base class for creating generic back-end views
 */
class GenericView extends HtmlView
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     * @return mixed            A string if successful, Error object if not
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->state    = $this->get('State');
        $this->config   = ComponentHelper::getConfig();
        $this->menuitem = MenuHelper::getActive();

        // Add component toolbar items
        $this->addAdministratonToolbar();

        // Call and return the parent method
        return parent::display($tpl);
    }


    /**
     * Add items to the administration toolbar for this view
     * -------------------------------------------------------------------------
     */
    protected function addAdministratonToolbar()
    {
    }


}
