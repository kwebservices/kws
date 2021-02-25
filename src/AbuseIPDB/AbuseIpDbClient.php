<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <admin@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\AbuseIPDB;


use \GuzzleHttp\Client AS GuzzleHttpClient;


/**
 * Client for accessing the AbuseIPDB Api
 *
 * @see https://docs.abuseipdb.com/
 */
class AbuseIpDbClient
{

    /**
     * Base URi for all API reqeusts
     *
     * @var string
     */
    protected $baseUri = 'https://api.abuseipdb.com/api/v2/';


    /**
     * API key supplied by AbuseIPDB
     *
     * @var string
     */
    protected $apikey = '';


    /**
     * An instance of a HTTP client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client = null;



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param string    $apikey     A valid AbuseIPDB API key
     */
    public function __construct(string $apikey = '')
    {
        // Initialise some class properties
        $this->setApiKey($apikey);
        $this->client = new GuzzleHttpClient(['base_uri' => $this->baseUri]);
    }


    /**
     * Set the API key
     * -------------------------------------------------------------------------
     * @param string    $value  A valid AbuseIPDB API key
     *
     * @return void
     */
    public function setApiKey(string $value) : void
    {
        $this->apikey = $value;
    }


    /**
     * Get the API key
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apikey;
    }


    /**
     * Check/lookup a IPv4 or IPv6 address
     * -------------------------------------------------------------------------
     * @param  string   $address    An IPv4 or IPv6 address to check
     *
     * @return null|stdClass
     */
    public function getInfo(string $address)
    {
        return $this->call('check', ['ipAddress' => $address]);
    }


    /**
     * Execute an API call
     * -------------------------------------------------------------------------
     * @param  string   $resource   The API resource to access
     * @param  string[] $data       Data to send with the HTTP request
     *
     * @return null|stdClass
     */
    protected function call(string $resource, array $data = [])
    {
        $response = $this->client->request('GET', $resource, [
            'query'   => $data,
            'headers' => [
                'Accept' => 'application/json',
                'Key'    => $this->getApiKey()
            ],
        ]);

        // Process an return the result
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());
            return $result->data;
        } else {
            return NULL;
        }
    }


}
