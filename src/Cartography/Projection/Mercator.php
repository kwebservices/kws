<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\Projection;


/**
 * The Mercator projection. Lines of constant bearing (rhumb lines) are
 * straight, aiding navigation. Areas inflate with latitude, becoming so
 * extreme that the map cannot show the poles.
 */
class Mercator extends Projection
{
}
