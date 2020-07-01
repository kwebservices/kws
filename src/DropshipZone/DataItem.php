<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\DropshipZone;


/**
 * Base class for all single dropshipzone items
 */
class DataItem
{

    /**
     * Holds the raw product data
     *
     * @var string[]
     */
    protected $data = [];



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param array     $data   Raw product data as an array
     */
    public function __construct(array $data)
    {
        // Initialise some class properties
        $this->data = $data;
    }


    /**
     * Get a single item from the raw product data
     * -------------------------------------------------------------------------
     * @param  string   $key        Key/column to get data from
     * @param  mixed    $default    Value to return iof no found
     * @param  string   $type       Type of data to return
     *
     * @return mixed|null
     */
    protected function get(string $key, $default = null, $type = 'string')
    {
        if (isset($this->data[$key])) {

            $result = $this->data[$key];

            switch ($type) {
                case 'int':
                    $result = preg_replace('|[^0-9.]|i','', $result);
                    $result = (int) $result;
                    break;

                case 'float':
                    $result = preg_replace('|[^0-9.]|i','', $result);
                    $result = (float) $result;
                    break;

                case 'bool':
                    $result = (bool) $result;
                    break;

                default:
                    $result = (string) $result;
                    break;
            }

            return $result;

        } else {
            return $default;
        }
    }

}
