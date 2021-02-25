<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Helper;


use \Dompdf\Dompdf;
use \ScssPhp\ScssPhp\Compiler AS SCSSCompiler;
use \ZipArchive;


/**
 * Helper oclass for miscellanious/currently unorganised methods
 */
class MiscHelper extends Helper
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
        $dompdf->setIsRemoteEnabled(true);
        $dompdf->setIsPhpEnabled(true);
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


    /**
	 * Method to convert a given number of bytes to KiB
	 * string (1024 bytes = 1 KiB)
	 * -------------------------------------------------------------------------
	 * @param  	integer 	$bytes         	The value to convert
	 * @param  	integer 	$decimalPlaces 	Number of decimals places
	 *
	 * @return 	string
	 */
	public static function bytesToKiB($bytes, $decimalPlaces = 2)
	{
		return number_format($bytes/1024, $decimalPlaces, '.', '');
	}


	/**
	 * Method to convert a given number of bytes to MiB
	 * string (1048576 bytes = 1 KMiB)
	 * -------------------------------------------------------------------------
	 * @param  	integer $bytes         	The value to convert
	 * @param  	integer $decimalPlaces 	Number of decimals places
	 *
	 * @return 	string
	 */
	public static function bytesToMiB($bytes, $decimalPlaces = 2)
	{
		return number_format($bytes/1048576, $decimalPlaces, '.', '');
	}

}
