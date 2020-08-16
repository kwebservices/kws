<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2020 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS;


use \Dompdf\Dompdf;
use \ScssPhp\ScssPhp\Compiler AS SCSSCompiler;
use \ZipArchive;


/**
 * Class for miscellanious/currently unorganised utilities
 */
class Utils
{

    /**
     * Encode/create a Data Uri (sometimes used in HTML src attributes, etc)
     * from some data (such as the contents of a image file)
     * -------------------------------------------------------------------------
     * @param  string $data         Data to encode
     * @param  string $mimeType     MIME type of data (eg: image/jpg)
     *
     * @return string   A data URI
     */
    public static function encodeDataUri(string $data, string $mimeType)
    {
        return 'data:' . $mimeType . ';base64,' . base64_encode($data);
    }


    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function disableCache() : void
    {
        header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    }

    /**
     * Convert HTML to PDF document
     * -------------------------------------------------------------------------
     * @param  string   $html           The HTML to convert
     * @param  string   $size           Paper size (eg: A4,A3,A5,etc)
     * @param  string   $orientation    Page orientation (portrait/landscape)
     *
     * @return mixed    A raw PDF file
     */
    public static function convertHtmlToPDF(string $html, string $size = 'A4',
        $orientation = 'portrait')
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($size, $orientation);
        $dompdf->render();
        return $dompdf->output();
    }

    /**
     * Compile SCSS code to CSS
     * -------------------------------------------------------------------------
     * @param  string   $inputFile    File containing SCSS code
     * @param  string   $outputFile   File to output the CSS to
     *
     * @return void
     */
    public static function compileSCSS(string $inputFile, string $outputFile) : void
    {
        // Load the SCSS code from file
        $scss = file_get_contents($inputFile);

        // Compile the SCSS to CSS
        $compiler = new SCSSCompiler();
        $compiler->setFormatter('ScssPhp\ScssPhp\Formatter\Compact');
        $compiler->addImportPath(dirname($inputFile));
        $css = $compiler->compile($scss);

        // save the generated CSS to file
        file_put_contents($outputFile, $css);
    }


    /**
     * Get the ordinal number suffix ("st","nd","rd" or "th") for a given
     * cardinal number
     * -------------------------------------------------------------------------
     * @param  int    $number   A cardinal number
     *
     * @return string
     */
    public static function getOrdinal(int $number) : string
    {
        $suffixes = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number % 100) <= 13))
            return 'th';
        else
            return $suffixes[$number % 10];

    }


    /**
     * Enable all PHP error reporting
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function enableFullErrorReporting() : void
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }



    /**
     * Disable all PHP error reporting
     * -------------------------------------------------------------------------
     * @return void
     */
    public function disableAllErrorReporting() : void
    {
        error_reporting(E_NONE);
        ini_set('display_errors', 0);
    }


    /**
     * Convert a given number of seconds into a hour:minute:seconds string
     * -------------------------------------------------------------------------
     * @param  int      $seconds    The value to convert
     * @param  string   $separator  Charictar/string to seperate the hr,min,sec.
     *
     * @return string   A string containing hours, minutes and seconds
     */
    public static function secondsToHMS($seconds, $separator = ':')
    {
        // Compose the result
        $hrs    = str_pad(floor($seconds/3600), 2, '0', STR_PAD_LEFT);
        $min    = str_pad(($seconds/60) % 60, 2, '0', STR_PAD_LEFT);
        $sec    = str_pad($seconds % 60, 2, '0', STR_PAD_LEFT);
        $result = $hrs . $separator . $min . $separator . $sec;

        // Return the result
        return $result;
    }



    /**
     * Convert an array to a string.
     * -------------------------------------------------------------------------
     * @param   array  $array          The array to convert.
     * @param   string $innerGlue      The glue between the key and the value.
     * @param   string $outerGlue      The glue between array elements.
     * @param   bool   $quoteChar      Charictar to surround the value with.
     * @param   bool   $finalGlue      Add the outerGlue to the last item
     *
     * @return  string
     */
     public static function arrayToString(array $array, string
        $innerGlue = '=', string $outerGlue = ' ',
        string $quoteChar = '"', bool $finalGlue = true)
    {
        $output = array();

        foreach ($array as $key => $item) {

            if (\is_array($item)) {
                $output[] = static::arrayToString($item, $innerGlue,
                    $outerGlue, $quoteChar, $finalGlue);
            } else {
                $output[] = $key . $innerGlue . $quoteChar .
                    $item . $quoteChar;
            }
        }

        $result  = implode($outerGlue, $output);
        $result .= ($finalGlue) ? $outerGlue  : '';

        return $result;
    }



    /**
     * Convert an associtive array into a CSS rule. Keys are treated as CSS
     * property names and values are treated as values for the corrasponding
     * property.
     * ------------------------------------------------------------------------
     * @param  string  $selector       A CSS selector for the CSS rule
     * @param  array   $properties     A list of CSS property => value pairs
     *
     * @return string  A CSS rule
     */
    public static function arrayToCSSRule(string $selector, array $properties) : string
    {
        $result  = $selector . ' { ';
        $result .= static::arrayToString($properties, ': ', '; ', '');
        $result .= '}';

        // Return the result
        return $result;
    }



    /**
     * Find which array element contains the closest value to the one provided.
     * This method only works on arrays containing int or float values
     * --------------------------------------------------------------------------
     * @param  float         $value     The value to use
     * @param  float[]       $array     A list of float or int values
     *
     * @return int|string    The key of the element which is closest
     */
     public static function arrayClosestValue(float $value, array $array)
     {
         // Initlise some local variables
         $closest = null;

         // Find the element with the closest value
         foreach ($array as $key => $item) {

             if ($closest === null || abs($value - $closest) >
                 abs($item - $value)) {

                 $closest = $item;
                 $result  = $key;

             }
         }

         // Return the result
         return $result;
     }


     /**
      * Gets the average of a list of values
      * -------------------------------------------------------------------------
      * @param  array  $values   A list of values
      *
      * @return float
      */
     public function arrayAverage(array $values)
     {
         $values = array_filter($values, function($x) { return $x !== ''; });
         return array_sum($values) / count($values);
     }


    /**
     * Block access to the site with a given HTTP response code and message
     * ------------------------------------------------------------------------
     * @param integer $httpCode        HTTP response code to send
     * @param string  $httpMessage     Message to send with the response code
     */
    public static function blockAccess(int $httpCode = 403, string
        $httpMessage = 'Forbidden') : void
    {
        header("HTTP/1.0 $httpCode $httpMessage");
        die();
    }



    /**
     * Redirect the user's browser to another URL, optionally preserving the
     * current URL parameters. If no url is given, the cuurent url will be
     * used.This can be useful for returning to form submission pages but be
     * careful not to create infinate redirects
     * -------------------------------------------------------------------------
     * @param string  $url              URL to redirect the user to
     * @param bool    $preserveParams   Pass existing URL params to the redirect
     * @param int     $statusCode        HTTP status code (usually 301 or 303)
     *
     * @return  void
     */
    public static function redirect(string $url = '', bool $preserveParams =
        false, int $statusCode = 301) : void
    {
        // Initialise some local variables
        $requestUri = $_SERVER['REQUEST_URI'];
        $queryStr   = $_SERVER['QUERY_STRING'];

        // If no url is given, use the current url. This can be useful for
        // returning to form submission page
        $url = (empty($url)) ? $requestUri : $url;

        // Append the exiting params if needed
        if (($preserveParams) && (!empty($queryStr))) {
            $url = $url . ((strpos($url, '?')) ? '&' : '?') . $queryStr;
        }

        // Redirect the user
        header('Location: ' . $url, true, $statusCode);
        exit();
    }



    /**
     * Send a very basic HTTP request and return the response body
     * -------------------------------------------------------------------------
     * @param  string   $url        The URL to send the quest to
     * @param  string   $method     The HTTP verb/type of request to use
     * @param  array    $data       Data to send with the request
     * @param  string[] $headers    Data to send with the request
     *
     * @return string               The reponse body
     */
    public static function sendRequest(string $url, string $method = 'GET',
        $data =array(), $headers = array())
    {
        // Compose a HTTP request using Guzzle HTTP
        $request = new \GuzzleHttp\Psr7\Request($method, $url, $headers);

        // Execute the http request with Guzzle HTTP
        $client = new \GuzzleHttp\Client();
        $result = $client->send($request, array('query' => $data));

        // Return the result body
        return $result->getBody();
    }


    /**
     * Create a basic Zip archive from a list files and return it's raw contents
     * -------------------------------------------------------------------------
     * @param  array  $files    File to add to the archive
     *
     * @return string
     */
    public static function createZipArchive(array $files) : string
    {
        // Create temporary archive
        $filename = tempnam(sys_get_temp_dir(), 'kws');
        $archive = new ZipArchive();
        $archive->open($filename, ZipArchive::CREATE);

        // Add files to the archive
        foreach($files as $file) {
            $archive->addFromString(basename($file), file_get_contents($file));
        }

        // Get and return the archive's raw contents
        $archive->close();
        return file_get_contents($filename);
    }

}
