<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\Google;

use \GuzzleHttp\Client AS HttpClient;


/**
 * Class for rendering and checking a Google ReCaptcha 3 widget
 */
class ReCaptcha
{

    /**
     * ReCaptcha site key (issued by Google)
     *
     * @var string
     */
    protected $siteKey = '';


    /**
     * ReCaptcha secret key (issued by Google)
     *
     * @var string
     */
    protected $secretKey = '';



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param string    $siteKey    A ReCaptcha site key issued by Google
     * @param string    $secretKey  A ReCaptcha secret key issued by Google
     */
    public function __construct(string $siteKey = null, string $secretKey = null)
    {
        // Initialise some class properties
        $this->setSiteKey($siteKey);
        $this->setSecretKey($secretKey);
    }


    /**
     * Set the site key used to indentify the site
     * -------------------------------------------------------------------------
     * @param  string    $key   A ReCaptcha site key issued by Google
     *
     * @return \KWS\Google\ReCaptcha
     */
    public function setSiteKey(string $key) : ReCaptcha
    {
        $this->siteKey = trim($key);
    }


    /**
     * Get the site key used to indentify the site
     * -------------------------------------------------------------------------
     * @return null|string
     */
    public function getSiteKey() : ?string
    {
        return $this->siteKey;
    }


    /**
     * Set the secret key used to check the ReCaptcha
     * -------------------------------------------------------------------------
     * @param  string    $key   A ReCaptcha secret key issued by Google
     *
     * @return \KWS\Google\ReCaptcha
     */
    public function setSecretKey(string $key) : ReCaptcha
    {
        $this->secretKey = trim($key);
    }


    /**
     * Get the secret key used to check the ReCaptcha
     * -------------------------------------------------------------------------
     * @return null|string
     */
    public function getSecretKey() : ?string
    {
        return $this->secretKey;
    }


    /**
     * Render the HTML required to display a reCAPTCHA 3
     * -------------------------------------------------------------------------
     * @return string
     */
    public function render() : string
    {
        // Initialise some local variables
        $siteKey = $this->getSiteKey();

        // Check that we have valid site key
        if (empty($siteKey)) {
            throw new \Exception("Missing ReCaptcha Site Key");
        }

        $jsUrl   = "https://www.google.com/recaptcha/api.js";
        $result  = "<script src=\"$jsUrl\" async defer></script>\n";
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
    public function check()
    {
        // Initialise some local variables
        $secretKey = $this->getSecretKey();
        $response  = $_POST['g-recaptcha-response'] ?? '';

        // Check that we have valid secret key
        if (empty($secretKey)) {
            throw new \Exception("Missing ReCaptcha Secret Key");
        }

        // Send POST http request to verify the response with Google
        $client = new HttpClient();
        $url    = 'https://www.google.com/recaptcha/api/siteverify';
        $params = ['secret' => $secretKey, 'response' => $response];
        $result = $client->post($url, ['form_params' => $params]);
        $result = json_decode($result->getBody());

        // Check google's response
        $result = $result->success == true;

        // Return the result
        return $result;
    }


}
