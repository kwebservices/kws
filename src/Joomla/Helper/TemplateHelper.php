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
 * Helper/utility class for working with template extensions
 */
class TemplateHelper
{

    /**
     * The current template
     *
     * @var \Joomla\Registry\Registry
     */
    protected $template = null;


    /**
     * Global document object
     *
     * @var \Joomla\CMS\Document\Document
     */
    protected $document = null;


    /**
     * Absolute path to the template's folder
     * -------------------------------------------------------------------------
     * @var string
     */
    public $basePath = '';


    /**
     * Base URL to the template's folder
     * -------------------------------------------------------------------------
     * @var string
     */
    public $baseUrl = '';



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function __construct()
    {
        // Init some class variables
        $this->template = Factory::getApplication()->getTemplate(true);
        $this->document = Factory::getDocument();
        $this->basePath = JPATH_THEMES . DIRECTORY_SEPARATOR . $this->template->template;
        $this->baseUrl  = Factory::getUri()->base() . 'templates/'. $this->template->template;
    }


    /**
     * Initialise the helper/template
     * -------------------------------------------------------------------------
     * @return void
     */
    public function initialise() : void
    {
        // Set the document type to HTML5
        $this->document->setHtml5(true);

        // Initialise all stylesheets
        $this->initStylesheets();

        // Initialise all javascript
        $this->initScripts();

        // Initialise all favicons
        $this->initFavicons();

        // Initialise all HTML meta tags
        $this->initMetaData();
    }



    /**
     * Add, update or remove all external stylesheets and internal CSS
     * -------------------------------------------------------------------------
     * @return void
     */
    protected function initStylesheets() : void
    {
    }


    /**
     * Add, update or remove all javascript, etc in the documents head section
     * -------------------------------------------------------------------------
     * @return void
     */
    protected function initScripts() : void
    {
    }


    /**
     * Add, update or remove all favicons
     * -------------------------------------------------------------------------
     * @return void
     */
    protected function initFavicons() : void
    {
    }


    /**
     * Add, update or remove all HTML meta tags
     * -------------------------------------------------------------------------
     * @return void
     */
    protected function initMetaData() : void
    {
        // Add a standard viewport meta tag
        $this->document->setMetaData('viewport',
            'width=device-width, initial-scale=1');

        // Remove the generator meta tag (if it exists)
        $this->document->setGenerator('');

        // Use the page title (without the site name) as the meta title
        $this->document->setMetaData('title',
            DocumentHelper::getTitle());
    }


}
