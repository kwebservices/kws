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
 * Class that represents and manipulate a DropshipZone SKU product list
 */
class SkuList
{

    /**
     * A list of products
     *
     * @var \stdClass[]
     */
    public $products = array();



    /**
     * Load a list of products from a CSV file
     * -------------------------------------------------------------------------
     * @param  string   $filename   Abolute path to a CSV file
     *
     * @return void
     */
    public function load(string $filename)
    {
        // Parse the CSV data
        $csvReader = CsvReader::createFromPath($filename, 'r');
        $csvReader->setHeaderOffset(0);
        $items = iterator_to_array($csvReader->getRecords());

        // Process each product
        $this->products = array();
        foreach ($items as $item) {
            $product               = new \stdClass;
            $product->sku          = $item['SKU']  ?? '';
            $product->category     = $item['Category']  ?? '';
            $product->title        = $item['Title']  ?? '';
            $product->qty          = $item['Stock Qty']  ?? '';
            $product->status       = $item['Status']  ?? '';
            $product->price        = $item['price']  ?? '';
            $product->rrp          = $item['RrpPrice']  ?? '';
            $product->vic          = $item['VIC']  ?? '';
            $product->nsw          = $item['NSW']  ?? '';
            $product->sa           = $item['SA']  ?? '';
            $product->qld          = $item['QLD']  ?? '';
            $product->tas          = $item['TAS']  ?? '';
            $product->wa           = $item['WA']  ?? '';
            $product->nt           = $item['NT']  ?? '';
            $product->bulky        = $item['bulky item']  ?? '';
            $product->discontinued = $item['Discontinued']  ?? '';
            $product->ean          = $item['EAN Code']  ?? '';
            $product->brand        = $item['Brand']  ?? '';
            $product->weight       = $item['Weight (kg)']  ?? '';
            $product->length       = $item['Carton Length (cm)']  ?? '';
            $product->width        = $item['Carton Width (cm)']  ?? '';
            $product->height       = $item['Carton Height (cm)']  ?? '';
            $product->desc         = $item['Description']  ?? '';
            $product->color        = $item['Color']  ?? '';
            $product->image1       = $item['Image 1']  ?? '';
            $product->image2       = $item['Image 2']  ?? '';
            $product->image3       = $item['Image 3']  ?? '';
            $product->image4       = $item['Image 4']  ?? '';
            $product->image5       = $item['Image 5']  ?? '';
            $product->image6       = $item['Image 6']  ?? '';
            $product->image7       = $item['Image 7']  ?? '';
            $product->image8       = $item['Image 8']  ?? '';
            $product->image9       = $item['Image 9']  ?? '';
            $product->image10      = $item['Image 10']  ?? '';
            $product->image11      = $item['Image 11']  ?? '';
            $product->image12      = $item['Image 12']  ?? '';
            $product->image13      = $item['Image 13']  ?? '';
            $product->image14      = $item['Image 14']  ?? '';
            $product->image15      = $item['Image 15' ] ?? '';

            $this->products[]      = $product;
        }

    }


}
