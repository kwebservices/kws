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
 * The Web Mercator projection. Variant of Mercator that ignores Earth's
 * ellipticity for fast calculation, and clips latitudes to ~85.05° for square
 * presentation. De facto standard for Web mapping applications.
 */
class WebMercator extends Projection
{
}
