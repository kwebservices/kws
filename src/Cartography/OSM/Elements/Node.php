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
        $data = ($xml instanceof \SimpleXMLElement) ?
            $xml : new \SimpleXMLElement($xml);

        // Load values from XML attributes
        $this->id        = (string) $data['id'] ?? '';
        $this->lat       = (string) $data['lat'] ?? '';
        $this->lon       = (string) $data['lon'] ?? '';
        $this->user      = (string) $data['user'] ?? '';
        $this->uid       = (string) $data['uid'] ?? '';
        $this->visible   = (string) $data['visible'] ?? '';
        $this->version   = (string) $data['version'] ?? '';
        $this->changeset = (string) $data['changeset'] ?? '';
        $this->timestamp = (string) $data['timestamp'] ?? '';

        // Parse any tag elements
        foreach ($data->tag as $tag) {
            $this->tags[] = new Tag($tag);
        }
    }

}
