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

use \KWS\Helper\UriHelper;
use \Joomla\CMS\Factory;



/**
 * Helper/utility class for working with template extensions
 */
class TemplateHelper extends Helper
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
    }


    /**
     * Add an external stylesheet to the document
     * -------------------------------------------------------------------------
     * @param string    $uri    Absolute or relative uri to template's base url
     *
     * @return void
     */
    public function addStylesheet(string $uri) : void
    {
        $this->document->addStylesheet(UriHelper::resolve($this->baseUrl, $uri));
    }


    /**
     * Add an external script to the document
     * -------------------------------------------------------------------------
     * @param string    $uri    Absolute or relative uri to template's base url
     *
     * @return void
     */
    public function addScript(string $uri) : void
    {
        $this->document->addScript(UriHelper::resolve($this->baseUrl, $uri));
    }

}
