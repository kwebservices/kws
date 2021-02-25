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


class Relation extends Element
{
    public $id        = '';
    public $user      = '';
    public $uid       = '';
    public $visible   = '';
    public $version   = '';
    public $changeset = '';
    public $timestamp = '';
    public $members   = [];
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
        $this->user      = (string) $data['user'] ?? '';
        $this->uid       = (string) $data['uid'] ?? '';
        $this->visible   = (string) $data['visible'] ?? '';
        $this->version   = (string) $data['version'] ?? '';
        $this->changeset = (string) $data['changeset'] ?? '';
        $this->timestamp = (string) $data['timestamp'] ?? '';

        // Parse any member elements
        foreach ($data->member as $member) {
            $this->members[] = new Member($member);
        }

        // Parse any tag elements
        foreach ($data->tag as $tag) {
            $this->tags[] = new Tag($tag);
        }
    }
}
