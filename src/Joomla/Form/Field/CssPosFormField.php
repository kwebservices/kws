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
 * Custom Form field for selecting a value for the position CSS property
 */
class CssPosFormField extends \JFormFieldList
{

    protected $type = 'CssPosFormField';


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
        $options[]= HTMLHelper::_('select.option', 'static', 'Static');
        $options[]= HTMLHelper::_('select.option', 'absolute', 'Absolute');
        $options[]= HTMLHelper::_('select.option', 'fixed', 'Fixed');
        $options[]= HTMLHelper::_('select.option', 'relative', 'Relative');
        $options[]= HTMLHelper::_('select.option', 'sticky', 'Sticky');

		// Return the resulting options (as html)
		return $options;
	}


}
