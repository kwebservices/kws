<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Joomla3\Helper;

use KWS\Helper\UriHelper;
use Joomla\CMS\Factory;


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
     * 
     * @var string
     */
    public $basePath = '';


    /**
     * Base URL to the template's folder
     * 
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
        $this->document = Factory::getDocument();
        $this->template = Factory::getApplication()->getTemplate(true);        
        $this->basePath = JPATH_THEMES . DIRECTORY_SEPARATOR . $this->getName();
        $this->baseUrl  = Factory::getUri()->base() . 'templates/' . $this->getName() . '/';
    }

    
    /**
     * Add an external css stylesheet to the document
     * -------------------------------------------------------------------------
     * @param  mixed $url   Absolute or relative uri to template's base url
     * @return void
     */
    public function addExternalCss(string $url) : void
    {
        $url = UriHelper::resolve($this->baseUrl, $url);
        $this->document->addStylesheet($url);
    }

        
    /**
     * Add internal css to the document head section
     * -------------------------------------------------------------------------
     * @param  mixed $css   CSS code to be added
     * @return void
     */
    public function addInternalCss(string $css) : void
    {
        $this->document->addStyleDeclaration($css);
    }

    
    /**
     * Add an external script to the document
     * -------------------------------------------------------------------------
     * @param  mixed $url   Absolute or relative uri to template's base url
     * @return void
     */
    public function addExternalScript(string $url) : void
    {
        $url = UriHelper::resolve($this->baseUrl, $url);
        $this->document->addScript($url);        
    }

    
    /**
     * Add internal script to the document
     * -------------------------------------------------------------------------
     * @param  mixed $script    Javascript to be added
     * @return void
     */
    public function addInternalScript(string $script) : void
    {
        $this->document->addScriptDeclaration($script);
    }

    
    /**
     * Set the document to render a HTML5 doctype
     * -------------------------------------------------------------------------
     * @return void
     */
    public function setHtml5DocType() : void
    {
        $this->document->setHtml5(true);
    }

    
    /**
     * Remove the generator meta tag that is automatically added by Joomla
     * -------------------------------------------------------------------------
     * @return void
     */
    public function removeGeneratorMetaTag() : void
    {
        $this->document->setGenerator('');
    }
    
    
    /**
     * Set the page/document title to the site name. This can be handy 
     * on the home page
     * -------------------------------------------------------------------------
     * @return void
     */
    public function setPageTitleToSitename() : void
    {
        $this->document->setTitle(MiscHelper::getSiteName());
    }

    
    /**
     * Set the title meta tag. If no value is given than the title meta tag 
     * will be set to the page title.
     * -------------------------------------------------------------------------
     * @param  mixed $value     New value for the title meta tag
     * @return void
     */
    public function setMetaTitle(string $value = null) : void
    {        
        $value = $value ?? DocumentHelper::getTitle();
        $this->setMetaTag('title', $value);
    }

        
    /**
     * Set the the viewport meta tag
     * -------------------------------------------------------------------------
     * @param  mixed $value     New value for the viewport meta tag
     * @return void
     */
    public function setViewPort(string $value) : void
    {
        $this->setMetaTag('viewport', $value);
    }

    
    /**
     *  Set the value of any meta tag
     * -------------------------------------------------------------------------
     * @param  mixed $name      Name of the meta tag
     * @param  mixed $value     New value for the meta tag
     * @return void
     */
    public function setMetaTag(string $name, string $value) : void
    {
        $this->document->setMetaData($name, $value);
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
     * @param  mixed $path      Registry path (e.g view.articles.show)
     * @param  mixed $default    Default value if not found
     * @return void
     */
    public function getParam(string $path, $default = null)
    {
        return $this->template->params->get($path, $default);
    }


    /**
     * Initialise the helper/template
     * -------------------------------------------------------------------------
     * @return void
     */
    public function initialise() : void
    {      
        // Set the document type to HTML5
        $this->setHtml5DocType();

        // Remove the generator meta tag (if it exists)
        $this->removeGeneratorMetaTag();

        // If on home page, use the site name for the page title
        if (MiscHelper::isHomePage()) {
            $this->setPageTitleToSitename();
        }

        // Set the the meta title tag to the page title
        $this->setMetaTitle();
    }

}