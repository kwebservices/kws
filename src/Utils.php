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


/**
 * Class for miscellanious/currently unorganised utilities
 */
class Utils
{

    protected static $cardinalDirections = ['N','NNE','NE','ENE','E','ESE',
        'SE','SSE','S','SSW','SW','WSW','W','WNW','NW','NNW', 'N'];



    /**
     * Convert a  map tile's coordinates to lattitude-longitude coordinates
     * -------------------------------------------------------------------------
     * @param  int    $x    The map tile's x coordinate
     * @param  int    $y    The map tile's y coordinate
     * @param  int    $z    The map tile's z/zoom coordinate
     *
     * @return stdClass     An object containing the Lattitude and longitude
     *                      coordinates for (the top-left corner ?) of the tile.
     */
    public static function tileToLatlon(int $x, int $y, int $z)
    {
        // Initialise some local variables
        $result = new \stdClass;

        // Calculate the lat and lon for the given tile
        $n = pow(2, $z);
        $result->lon = $x / $n * 360.0 - 180.0;
        $result->lat = rad2deg(atan(sinh(pi() * (1 - 2 * $y / $n))));

        // Return the result
        return $result;
    }



    /**
     * Convert a lattitude, longitude and zoom level to map tile coordinates.
     * -------------------------------------------------------------------------
     * @param  float     $lat   Lattitude in decimal degrees (eg: -27.323232)
     * @param  float     $lon   Longitude in decimal degrees (eg: 159.292822)
     * @param  int       $zoom  Map zoom level (eg: 12)
     *
     * @return stdClass     An object containing x,y and z tile coordinates.
     */
    public static function latlonToTile(float $lat, float $lon, int $zoom)
    {
        // Initlise some local variables
        $result = new \stdClass;

        // Calculate the tile's x coordinate
        $result->x = floor((($lon + 180) / 360) * pow(2, $zoom));

        // Calculate the tile's y coordinate
        $result->y = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat)))
            / pi()) /2 * pow(2, $zoom));

        // Calculate the tile's z coordinate
        $result->z = $zoom;

        // Return the result
        return $result;
    }



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
     * Convert an Azimuth (a bearing in decimal degrees) to the nearest
     * cardinal direction (based on a 16 point compass).
     * -------------------------------------------------------------------------
     * @param   float   $azimuth An azimuth between 0 and 360 degrees.
     *
     * @return  string  A cardinal direction (eg: NNE)
     */
    public static function azimuthToCardinalDirection(float $azimuth)
    {
        $index  = round(($azimuth % 360) / 22.5);
        $result = static::$cardinalDirections[$index];

        // Return the result
        return $result;
    }



    /**
     * Convert a cardinal direction to an Azimuth (a bearing in decimal degrees).
     * North ("N") will return 0. (based on a 16 point compass).
     * -------------------------------------------------------------------------
     * @param    string  $direction  A cardinal direction (eg: NNE)
     *
     * @return float|false   An azimuth (bearing in degrees), False
     *                       if direction is invalid
     */
    public static function cardinalDirectionToAzimuth(string $direction)
    {
        $index  = array_search($direction, static::$cardinalDirections);
        $result = ($index === false) ? false : $index * 22.5;

        // Return the reuslt
        return $result;
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
     * Check if the current user agent is  googlebot
     *-------------------------------------------------------------------------
     * @return bool
     */
    public static function isGooglebot() : bool
    {
        return (bool) preg_match("/Google(bot)?/", $_SERVER['HTTP_USER_AGENT']);
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
     * Checks if a given value is a hexidecimal color value. Matches values
     * with/without a precceding hash. Matches 3 digit, 6 digit and 8 digit
     * color values ( eg: #FFF, #FFFFFF, #FFFFFFAA ).
     * -------------------------------------------------------------------------
     * @param   mixed   $value         The value to test
     *
     * @return  bool    True if the value is a hexidecimal number, False if not.
     */
    public static function isHexColor($value) : bool
    {
        $regex = "|^#?([0-9A-F]{3}|[0-9A-F]{6}|[0-9A-F]{8})$|i";
        return (bool) preg_match($regex, $value);
    }



    /**
     * Checks if a given value is a IPv4 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is a IPv4 address, False if not.
     */
    public static function isIPv4Address($value) : bool
    {
        return (bool) preg_match("|^([0-9]{1,3}\.){3}[0-9]{1,3}$|i", $value);
    }



    /**
     * Checks if a given value is a IPv6 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is a IPv6 address, False if not.
     */
    public static function isIPv6Address($value) : bool
    {
        return (bool) preg_match("|^([A-F0-9]{1,4}:){7}[A-F0-9]{1,4}$|i", $value);
    }



    /**
     * Checks if a given value is a IPv4 or IPv6 address
     * -------------------------------------------------------------------------
     * @param   string  $value  The value to test
     *
     * @return bool     True if the value is an IPv4/IPv6 address, False if not.
     */
    public static function isIPAddress($value) : bool
    {
        return static::isIPv4Address($value) || static::isIPv6Address($value);
    }



    /**
     * Checks if a given value is a valid day pf the week. Matches day
     * number (0 - 6) and various abbreviations.
     * -------------------------------------------------------------------------
     * @param   mixed   $value  The value to test
     *
     * @return  bool    True if a valid day of the week, False if not.
     */
    public static function isDayOfWeek($value) : bool
    {
        $regex = "^(?:mo(?:n(?:day)?)?|tu(?:e(?:s(?:day)?)?)?|" .
            "we(?:d(?:nsday)?)?|th(?:u(?:rs(?:day)?)?)?|fr(?:i(?:day)?)?|" .
            "sa(?:t(?:urday)?)?|su(?:n(?:day)?)?|[mtwfs0-6])$";

        return (bool) preg_match("#$regex#i", $value);
    }



    /**
     * Checks if a given value is gender.
     * -------------------------------------------------------------------------
     * @param  string   $value  The value to test
     *
     * @return bool     True if valid, False if not
     */
    public static function isGender(string $value) : bool
    {
        $rgex = '^(?:m(?:[ae]n|ale)?|boy|f(?:emale)?|wom[ae]n|girl)$';
        return  (bool) preg_match("#$regex#i", $value);
    }



    /**
     * Check if the given value contains HTML
     * -------------------------------------------------------------------------
     * @param  string $value    Content to be checked
     *
     * @return bool
     */
    public static function containsHTML(string $value)
    {
        return $value != strip_tags($value);
    }



    /**
     * Check if a given ip address is a private address. If no ip address
     * is given then the user's ip address will be used.
     * -------------------------------------------------------------------------
     * @param  string   $ip     An IP4 or IP6 address.
     *
     * @return bool
     */
    public static function isPrivateIPAddress(string $ip = '') : bool
    {
        // If no ip address was given, use the remote users ip
        $ip = (empty($ip)) ? $_SERVER['REMOTE_ADDR'] : $ip ;

        // Check if the given ip falls within private CDIRS
        $result = (bool) preg_match('#^(?:10|127)(?:\.\d{1,3}){3}$#', $ip) ||
            preg_match('#^(?:192\.168|172\.16)(?:\.\d{1,3}){2}$#', $ip);

        // Return the result
        return $result;
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
     * Convert all phone words to digits
     * -------------------------------------------------------------------------
     * @param  string   $value  A number containing phone words
     *
     * @return string
     */
    public static function phoneWordtoDigits(string $value) : string
    {
        // Replace all phone letters with numbers
        $result = preg_replace('|[abc]|i','2', $value);
        $result = preg_replace('|[def]|i','3', $result);
        $result = preg_replace('|[ghi]|i','4', $result);
        $result = preg_replace('|[jkl]|i','5', $result);
        $result = preg_replace('|[mno]|i','6', $result);
        $result = preg_replace('|[pqrs]|i','7', $result);
        $result = preg_replace('|[tuv]|i','8', $result);
        $result = preg_replace('|[wxyz]|i','9', $result);

        // Return the result
        return $result;
    }



    /**
     * Check if a given number contains phone words
     * -------------------------------------------------------------------------
     * @param  string   $value  A telephone number
     *
     * @return bool
     */
    public static function hasPhoneWords(string $value) : bool
    {
        return preg_match('|[a-z#*]|i', $value);
    }



    /**
     * Extracts all phone words from ta number. Each phone word needs to be
     * seperated by at least 1 digit or whitespace charictar
     * -------------------------------------------------------------------------
     * @param  string   $value  Number to extract phone words from
     *
     * @return string[]
     */
    public static function extractPhoneWords(string $value)
    {
        $result = array();
        preg_match_all("|[a-z]+|i", $value, $result);
        return $result[0] ?? array();
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
     * Get the HTML/Javascript for displaying a reCAPTCHA 3
     * -------------------------------------------------------------------------
     * @param  string   $key        reCAPTCHA Site Key (issued by Google)
     *
     * @return string   HTML/Javascript needed to render reCAPTCHA 3
     */
    public static function getReCaptchaHtml(string $siteKey)
    {
        $result  = "<script src=\"https://www.google.com/recaptcha/api.js\" async defer></script>\n";
        $result .= "<div class=\"g-recaptcha\" data-sitekey=\"$siteKey\"></div>";
        return $result;
    }



    /**
     * Check if the user was successfully completed a reCAPTCHA 3
     * -------------------------------------------------------------------------
     * @param  string   $key    reCAPTCHA Secret Key (issued by Google)
     *
     * @return  bool
     */
    public static function checkReCaptcha(string $secretKey)
    {
        // Initialise some local variables
        $response  = $_POST['g-recaptcha-response'] ?? '';

        // Send POST http request to verify the response with Google
        $client = new \GuzzleHttp\Client();
        $url    = 'https://www.google.com/recaptcha/api/siteverify';
        $params = ['secret' => $secretKey, 'response' => $response];
        $result = $client->post($url, ['form_params' => $params]);
        $result = json_decode($result->getBody());

        // Check google's response
        $result = $result->success == true;

        // Return the result
        return $result;
    }



    /**
     * Checks if a given value is a hexidecimal color value. Matches values
     * with/without a precceding hash. Matches 3 digit, 6 digit and 8 digit
     * color values ( eg: #FFF, #FFFFFF, #FFFFFFAA ).
     * -------------------------------------------------------------------------
     * @param  mixed    $value  The value to check
     *
     * @return bool
     */
    public static function isColor($value) : bool
    {
        $regex = "|^#?([0-9A-F]{3}|[0-9A-F]{6}|[0-9A-F]{8})$|i";
        return (bool) preg_match($regex, $value);
    }

}
