<?php

namespace Application\Model\ThingSpeak\Channel;

use Application\Model\ThingSpeak\Connector;

class Feed extends Connector
{
    CONST JSON_EXTENSION = '.json';
    CONST XML_EXTENSION = '.xml';

    public function buildUrl($size = 10)
    {
        // https://api.thingspeak.com/channels/88853/feeds.json?results=2
        $size = (int) $size;
        $url = Connector::BASE_URL . Connector::CHANNEL_ID;
        $url .= '/' . 'feeds' . $this::JSON_EXTENSION . '?' . 'results=' . $size;

        return $url;
    }

    public function getFeeds($size)
    {
        return $this->filterCollection($this->getResponse($size)->feeds);
    }

    protected function getResponse($size)
    {
        $request = $this->getGuzzleClient()->createRequest('GET', $this->buildUrl($size));
        $response = json_decode($request->send()->getBody());

        return $response;
    }

    protected function filterCollection(array $collection)
    {
        foreach ($collection as $item) {
            $field1 = $this->filterCorruptedStrings($item->field1);
            $field2 = $this->filterCorruptedStrings($item->field2);
            $field3 = $this->filterCorruptedStrings($item->field3);
            $field4 = $this->filterCorruptedStrings($item->field4);
            $item->field1 = $field1;
            $item->field2 = $field2;
            $item->field3 = $field3;
            $item->field4 = $field4;
        }
        return $collection;
    }

    protected function filterCorruptedStrings($textToFilter)
    {
        $corruptedStrings = array(
            "{\"reading\":[",
            "]}"
        );

        /** @TODO parameters needs to be string */

        foreach ($corruptedStrings as $corruptedString) {
            $textToFilter = str_replace($corruptedString, "", $textToFilter);
        }

        return $textToFilter;
    }

}