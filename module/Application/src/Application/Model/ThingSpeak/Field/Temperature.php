<?php

namespace Application\Model\ThingSpeak\Field;

use Application\Model\ThingSpeak\Connector;

class Temperature extends Connector
{
    CONST FIELD_ID = 1;
    CONST JSON_EXTENSION = '.json';
    CONST XML_EXTENSION = '.xml';

    public function buildUrl($size = 5)
    {
        $size = (int) $size;
        $url = Connector::BASE_URL . Connector::CHANNEL_ID;
        $url .= '/' . Connector::FIELDS . '/' . $this::FIELD_ID . $this::JSON_EXTENSION . '?' . 'results=' . $size;

        return $url;
    }

    public function getChannel()
    {
        return $this->getResponse()->channel;
    }

    public function getTemperaturesList()
    {
        return $this->getResponse()->feeds;
    }

    protected function getResponse()
    {
        $request = $this->getGuzzleClient()->createRequest('GET', $this->buildUrl());
        $response = json_decode($request->send()->getBody());

        return $response;
    }

}