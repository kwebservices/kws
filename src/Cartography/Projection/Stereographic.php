<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Cartography\Projection;


/**
 * The Stereographic projection. Map is infinite in extent with outer
 * hemisphere inflating severely, so it is often used as two hemispheres. Maps
 * all small circles to circles, which is useful for planetary mapping to
 * preserve the shapes of craters.
 */
class Stereographic extends Projection
{
}
