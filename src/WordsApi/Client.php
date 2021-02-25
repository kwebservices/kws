<?php
/**
 * =============================================================================
 * @package     KRealm Web Services PHP Library
 * @author      David Plath <webmaster@krealmwebservices.com.au>
 * @copyright   Copyright (C) 2021 KRealm Web Services. All rights reserved.
 * @license     GNU General Public License version 3 or later
 * =============================================================================
 */

namespace KWS\WordsApi;


/**
 * Class for working with the WordsApi API.
 *
 * @see https://www.wordsapi.com
 */
class Client
{


    protected $baseUri = 'https://wordsapiv1.p.rapidapi.com/words/';


    /**
     * An API key for accessing the API
     *
     * @var string
     */
    protected $apiKey = '';


    /**
     * A http client for sending/reciving requests to the api
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient = null;



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param string    $apiKey     An API key issued by the WordsAPI website
     */
    public function __construct(string $apiKey)
    {
        // Initialise some class properties
        $this->apiKey = trim($apiKey);

        // Initialise the http client
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUri,
            'headers'  => [
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com',
                'x-rapidapi-key' => $this->apiKey,
                'accept'        => 'application/json',
            ]
        ]);
    }


    /**
     * Call a given endpoint on the API and return the result
     * -------------------------------------------------------------------------
     * @param  string   $relUri     Endpoint Uri relative to the baseUri
     * @param  array    $params     Additional params to send with the request
     *
     * @return mixed
     */
    public function call(string $relUri, array $params = [])
    {
        // Initialise some local variables
        $result = false;

        // Send the request and get the response
        $response = $this->httpClient->request('GET', $relUri,
            ["query" => $params]);

        // If the reqeust was successful decode/parse the results
        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody());
        }

        // Return the result
        return $result;
    }


    /**
     * Get a list of meanings for given word, including its part of speech
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getDefinitions(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/definitions");
        $result = $result->definitions ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of words that can be interchanged for the original word in
     * the same context.
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getSynonyms(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/synonyms");
        $result = $result->synonyms ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of words that have the opposite context of the original word.
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getAntonyms(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/antonyms");
        $result = $result->antonyms ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of examples sentences using the word
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getExamples(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/examples");
        $result = $result->examples ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of rhymes for a given word
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getRhymes(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/rhymes");
        $result = $result->rhymes->all ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of syllables for a given word
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getSyllables(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call($word);
        $result = $result->syllables->list ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get the pronunciation for a given word
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getPronunciation(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call($word);
        $result = $result->pronunciation->all ?? [];

        // Return the result
        return $result;
    }


    /**
     * Get a list of frequency for a given word
     * -------------------------------------------------------------------------
     * @param  string   $word   The word to lookup
     *
     * @return array
     */
    public function getFrequency(string $word)
    {
        // Get and parse data from the api
        $word = trim($word);
        $result = $this->call("$word/frequency");
        $result = $result->frequency ?? [];

        // Return the result
        return $result;
    }

}
