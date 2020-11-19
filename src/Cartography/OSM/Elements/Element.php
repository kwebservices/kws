<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\OSM\Elements;


abstract class Element
{


    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed    $xml    XML string or SimpleXML object
     */
    public function __construct($xml = '')
    {
        if (!empty($xml)) {
            $this->loadFromXML($xml);
        }

    }

    
    /**
     * Load element data from XML string or SimpleXML object
     * -------------------------------------------------------------------------
     * @param mixed    $xml    XML string or SimpleXML object
     *
     * @return void
     */
    abstract public function loadFromXML($xml) : void;

}
