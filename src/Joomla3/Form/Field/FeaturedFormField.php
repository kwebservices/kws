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
FormHelper::loadFieldClass('radio');


/**
 * Custom Form field for selecting a "Featured" or "Unfeatured"
 */
class FeaturedFormField extends \JFormFieldRadio
{

    protected $type = 'FeaturedFormField';


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
		$options[]= HTMLHelper::_('select.option', '0', 'Unfeatured');
        $options[]= HTMLHelper::_('select.option', '1', 'Featured');

		// Return the resulting options (as html)
		return $options;
	}


}
