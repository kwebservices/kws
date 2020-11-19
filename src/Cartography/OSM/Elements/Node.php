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


class Node extends Element
{
    public $id        = '';
    public $lat       = '';
    public $lon       = '';
    public $user      = '';
    public $uid       = '';
    public $visible   = '';
    public $version   = '';
    public $changeset = '';
    public $timestamp = '';
    public $tags      = [];


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
        if (!$xml instanceof \SimpleXMLElement) {
            $data = new \SimpleXMLElement($xml);
        }

        // Load values from XML attributes
        $this->id        = $data['id'] ?? '';
        $this->lat       = $data['lat'] ?? '';
        $this->lon       = $data['lon'] ?? '';
        $this->user      = $data['user'] ?? '';
        $this->uid       = $data['uid'] ?? '';
        $this->visible   = $data['visible'] ?? '';
        $this->version   = $data['version'] ?? '';
        $this->changeset = $data['changeset'] ?? '';
        $this->timestamp = $data['timestamp'] ?? '';

        // Parse any tag elements
        foreach ($data->tag as $tag) {
            $this[] = new Tag($tag);
        }
    }

}
