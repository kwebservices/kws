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
        $this->basePath = JPATH_THEMES . DIRECTORY_SEPARATOR . $this->getName();
        $this->baseUrl  = Factory::getUri()->base() . 'templates/' . $this->getName() . '/';
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

        // Remove the generator meta tag (if it exists)
        $this->document->setGenerator('');

        // If on home page, set the document title and meta title to site name.
        // Othewise set the meta title to the document title (without sitename)
        if (MiscHelper::isHomePage()) {
            $this->document->setTitle(MiscHelper::getSiteName());
            $this->document->setMetaData('title', MiscHelper::getSiteName());
        } else {
            $this->document->setMetaData('title', DocumentHelper::getTitle());
        }

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


    /**
     * Set the the viewport meta tag
     * -------------------------------------------------------------------------
     * @param string    $value  New value for the viewport meta tag
     *
     * @return void
     */
    public function setViewport(string $value) : void
    {
        $this->document->setMetaData('viewport', $value);
    }


    /**
     * Get the name of the template
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getName() : string
    {
        return $this->template->template;
    }


    /**
     * Get the value of a given template parameter
     * -------------------------------------------------------------------------
     * @param  string       $path       Registry path (e.g view.articles.show)
     * @param  null|mixed   $default    Default value if not found
     *
     * @return mixed
     */
    public function getParam(string $path, $default = null)
    {
        return $this->template->params->get($path, $default);
    }

}
