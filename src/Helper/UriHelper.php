<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Helper;

use League\Uri\Uri;


/**
 * Helper class forworking with URIs
 */
class UriHelper extends Helper
{

    /**
     * Resolve/convert a relative URI to an absolute URI as any browser would
     * -------------------------------------------------------------------------
     * @param  string   $baseUri   Am absolute base URI
     * @param  string   $relUri    An absoluite or reltive uri
     *
     * @return string
     */
    public static function resolve(string $baseUri, string $relUri) : string
    {
        return Uri::createFromBaseUri($relUri, $baseUri);
    }

}
