<?php

/**
 * Class Connector
 */
namespace Application\Model\ThingSpeak;

use Guzzle\Http\Client;

abstract class Connector
{
    CONST BASE_URL = 'https://api.thingspeak.com/channels/';
    CONST CHANNEL_ID = 88853;
    CONST FIELDS = 'fields';

//    CONST TEST_URL = 'https://api.thingspeak.com/channels/20573/feeds.json?results=100';
//    CONST TEST_URL = 'https://api.thingspeak.com/channels/88853';

    protected $guzzleClient;

    /**
     * Build the url for API calls
     *
     * @param $params
     * @return mixed
     */
    abstract public function buildUrl($size);

    /**
     * Get Guzzle Client
     *
     * @return Client
     */
    public function getGuzzleClient()
    {
        if (is_null($this->guzzleClient)) {
            $this->guzzleClient = new Client();
            return $this->guzzleClient;
        }
        return $this->guzzleClient;
    }
}