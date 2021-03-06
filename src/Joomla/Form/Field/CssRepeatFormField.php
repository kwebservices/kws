<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla\Form\Field;

use \Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Form\FormHelper;


// Load the parent FormField class
FormHelper::loadFieldClass('list');


/**
 * Custom Form field for selecting a value for the background-repeat CSS property
 */
class CssRepeatFormField extends \JFormFieldList
{

    protected $type = 'CssRepeatFormField';


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
        $options[]= HTMLHelper::_('select.option', 'no-repeat', 'No Repeat');
        $options[]= HTMLHelper::_('select.option', 'repeat', 'Repeat');
        $options[]= HTMLHelper::_('select.option', 'repeat-x', 'Repeat X');
        $options[]= HTMLHelper::_('select.option', 'repeat-y', 'Repeat Y');
        $options[]= HTMLHelper::_('select.option', 'space', 'Space');
        $options[]= HTMLHelper::_('select.option', 'round', 'Round');

		// Return the resulting options (as html)
		return $options;
	}


}
