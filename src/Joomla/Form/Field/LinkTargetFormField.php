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
 * Custom Form field for selecting a link target
 */
class LinkTargetFormField extends \JFormFieldList
{

    protected $type = 'LinkTargetFormField';


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
        $options[]= HTMLHelper::_('select.option', '_blank', 'Blank');
        $options[]= HTMLHelper::_('select.option', '_self', 'Self');
        $options[]= HTMLHelper::_('select.option', '_parent', 'Parent');
        $options[]= HTMLHelper::_('select.option', '_top', 'Top');

		// Return the resulting options (as html)
		return $options;
	}


}
