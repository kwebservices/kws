<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\OSM\Elements;


class Tag extends Element
{
    public $key   = '';
    public $value = '';


    /**
     * Load element data from XML string or SimpleXML object
     * -------------------------------------------------------------------------
     * @param mixed    $xml    XML string or SimpleXML object
     *
     * @return void
     */
    public function loadFromXML($xml) : void
    {
        // Make sure we have a SimpleXML object
        $data = ($xml instanceof \SimpleXMLElement) ?
            $xml : new \SimpleXMLElement($xml);

        // Load values from XML attributes
        $this->key   = (string) $data['key'] ?? '';
        $this->value = (string) $data['value'] ?? '';
    }
}
