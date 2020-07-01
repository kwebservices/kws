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

use \League\Csv\Reader AS CsvReader;


/**
 * Class hold/process a list of dropship zone product updates
 */
class UpdateList extends DataList
{

    /**
     * Load the product list from a dropshipzone SKU file
     * -------------------------------------------------------------------------
     * @param  string   $filename   Absolute path to the file
     *
     * @return void
     */
    public function loadFromFile(string $filename)
    {
        // Clear all existing items
        $this->items = [];

        // Parse the CSV data
        $csvReader = CsvReader::createFromPath($filename, 'r');
        $csvReader->setHeaderOffset(0);
        $items = iterator_to_array($csvReader->getRecords());

        // Add new products
        foreach ($items as $item) {
            $this->items[] = new Update($item);
        }
    }

}
