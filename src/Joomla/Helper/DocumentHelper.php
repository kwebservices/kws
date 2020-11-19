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

use \Joomla\CMS\Factory;


/**
 * Helper/utility class for working with Joomla's document object
 */
class DocumentHelper
{

    /**
     * Get the current page title without a sitename prefix/suffix
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getTitle()
    {
        // Initialise some local variables
        $document = Factory::getDocument();
        $config   = Factory::getConfig();

        // Get the current page title
        $result = $document->getTitle();

        // Strip the sitename if it has been added
        $sitename = $config->get('sitename');
        $result = str_replace(" - $sitename", "", $result);
        $result = str_replace("$sitename - ", "", $result);

        // Return the result
        return $result;
    }


}
