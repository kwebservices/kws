<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\OSM\Elements;


class Bounds extends Element
{
    public $minlat = '';
    public $minlon = '';
    public $maxlat = '';
    public $maxlon = '';


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
        $this->minlat = (string) $data['minlat'] ?? '';
        $this->minlon = (string) $data['minlon'] ?? '';
        $this->maxlat = (string) $data['maxlat'] ?? '';
        $this->maxlon = (string) $data['maxlon'] ?? '';
    }

}
