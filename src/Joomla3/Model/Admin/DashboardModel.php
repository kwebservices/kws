<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Model\Admin;


/**
 * Base class for creating dashboard back-end models
 */
class DashboardModel extends GenericModel
{

    /**
     * Method to get a list of quickicons
     * -------------------------------------------------------------------------
     * @return \stdClass[]
     */
    public function getQuickIcons()
    {
        return [];
    }


    /**
     * Get statistical information
     * -------------------------------------------------------------------------
     * @return \stdClass
     */
    public function getStatistics()
    {
		// Get all available statistics
		$result = new \stdClass();
		$result->server   =	$this->getServerStatistics();
		$result->database =	$this->getDatabaseStatistics();

		// Return the result
		return $result;
    }


    /**
	 * Get info about server hosting the website
	 * -------------------------------------------------------------------------
	 * @return 	object 	The statistics
	 */
	protected function getServerStatistics()
	{
		//  Initalize some local variables
		$result = new \stdClass();

		// Add data to the result
		$result->ipaddress      = $_SERVER['SERVER_ADDR'];
		$result->name           = $_SERVER['SERVER_NAME'];
		$result->software       = $_SERVER['SERVER_SOFTWARE'];
		$result->protocol       = $_SERVER['SERVER_PROTOCOL'];
		$result->docroot        = $_SERVER['DOCUMENT_ROOT'];
		$result->os             = PHP_OS;
		$result->php_version    = PHP_VERSION;
		$result->php_extensions = get_loaded_extensions();

		// Return the result
		return $result;
	}


    /**
	 * Get info about the database
	 * -------------------------------------------------------------------------
	 * @return \stdClass
	 */
	protected function getDatabaseStatistics()
	{
		//  Initalize some local variables
		$result   = new \stdClass();
		$database = $this->getDbo();

		// Add the a list of charictar sets
		$result->charsets = $database
            ->setQuery('SHOW CHARACTER SET')
            ->loadRowList();

        // Add the a list of supported engines
		$result->engines = $database
            ->setQuery('SHOW ENGINES')
            ->loadRowList();

        // Add a list database session variables
        $result->sessionvars = $database
            ->setQuery('SHOW SESSION VARIABLES')
            ->loadRowList();

		// Add the a list of collations
		$result->collations = $database
            ->setQuery('SHOW COLLATION')
            ->loadRowList();

		// Return the result
		return $result;
	}

}
