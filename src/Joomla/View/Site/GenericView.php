<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\View\Site;

use \KWS\Joomla\Helper\ComponentHelper;
use \KWS\Joomla\Helper\MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;


/**
 * Base class for creating generic front-end views
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

        // Call and return the parent method
        return parent::display($tpl);
    }

}
