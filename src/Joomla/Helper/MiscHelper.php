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
 * Helper/utility class for miscellaneous joomla methods
 */
class MiscHelper extends Helper
{

    /**
	 * Method to sanitise an alias value. Valid aliases contain only
	 * alpha-numberic and hyphen charictars - all other charictars are
	 * replaced with hyphens. In addition, aliases must not be empty.
	 * -------------------------------------------------------------------------
	 * @param 	string $alias 		The alias to sanitise
	 * @param   string $default 	A default value to return if the the
	 *                              alias is/becomes empty
	 *
	 * @return 	string
	 */
	public static function sanitiseAlias($alias, $default = 'noname')
	{
		// Remove any leading and/or trailing whitespace
		$result = trim($alias);

		// Convert to lower case
		$result = strtolower($result);

		// Remove any charictars that are not alpha-numeric or "-"
		$result = preg_replace('/[^a-z0-9]/i', '-', $result);

		// Remove any multiple hyphens ("-")
		$result = preg_replace('/-{2,}/i', '-', $result);

		// If the alias is/has become empty use a default alias value
		$result = (empty($result)) ? $default : $result;

		// Return the result
		return $result;
	}


	/**
	 * Method to check if a given alias already exists
	 * -------------------------------------------------------------------------
	 * @param 	string $alias 	The alias to check for
	 * @param   string $table 	The name is the db table to look up
	 * @param   string $field 	THe db table field that holds alias values
	 *
	 * @return 	bool
	 */
	public static function aliasExists($alias, $table, $field = 'alias')
	{
		// Initialise some local variables
		$database = Factory::getDbo();

		// Check if the alias already exists
		$query = $database->getQuery(true);
		$query->select('COUNT(*)');
		$query->from("$table AS a");
		$query->where("a.$field = '$alias'");
		$result = $database->setQuery($query)->loadResult() > 0;

		// Return the result
		return $result;
	}


    /**
	 * Method to determine if a given string is a valid email address
	 * -------------------------------------------------------------------------
	 * @param  string 	$value 	The value to test
	 *
	 * @return bool
	 */
	public static function isEmailAddress($value)
	{
		return (bool) Factory::getMailer()->ValidateAddress($value);
	}


}
