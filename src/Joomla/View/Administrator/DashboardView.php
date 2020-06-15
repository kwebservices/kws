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


/**
 * Base class for creating dashboard based back-end views
 */
class DashboardView extends GenericView
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     *
     * @return mixed            A string if successful, Error object if not
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->quickicons = $this->get('QuickIcons');
        $this->statistics = $this->get('Statistics');

        // Call and return the parent method
		return parent::display($tpl);
    }

}
