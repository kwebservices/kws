<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Legacy\FuelPHP\Orm;



class Model extends \Orm\Model
{


    public function hydrateFromInput()
    {
        $properties = array_keys($this->properties());

        foreach ($properties as $name) {

            $value = \Input::param($name, null);

            if (!is_null($value)) {
                $this->set($name, $value);
            }
        }

    }

}
