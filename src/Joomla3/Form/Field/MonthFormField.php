<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Form\Field;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Form\FormHelper;


// Load the parent FormField class
FormHelper::loadFieldClass('list');


/**
 * Custom Form field for selecting a month of the year
 */
class MonthFormField extends \JFormFieldList
{

    protected $type = 'MonthFormField';


    /**
	 * Get a list of field options.
	 * -------------------------------------------------------------------------
	 * @return 	array 	An array of options (as HTML)
	 */
	protected function getOptions()
	{
        // Call the parent method
        $options = parent::getOptions();

		// Add field options to the result
        $options[]= HTMLHelper::_('select.option', '1', 'January');
        $options[]= HTMLHelper::_('select.option', '2', 'February');
        $options[]= HTMLHelper::_('select.option', '3', 'March');
        $options[]= HTMLHelper::_('select.option', '4', 'April');
        $options[]= HTMLHelper::_('select.option', '5', 'May');
        $options[]= HTMLHelper::_('select.option', '6', 'June');
        $options[]= HTMLHelper::_('select.option', '7', 'July');
        $options[]= HTMLHelper::_('select.option', '8', 'August');
        $options[]= HTMLHelper::_('select.option', '9', 'September');
        $options[]= HTMLHelper::_('select.option', '10', 'October');
        $options[]= HTMLHelper::_('select.option', '11', 'November');
        $options[]= HTMLHelper::_('select.option', '12', 'December');

		// Return the resulting options (as html)
		return $options;
	}


}
