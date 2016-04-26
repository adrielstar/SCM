<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Model\ThingSpeak\Field\Temperature;
use Application\Model\ThingSpeak\Channel\Feed;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $size = (int) $request->getQuery('size');

        // Fixed values
        if (!($size > 5) || $size > 1000) {
            $size = 5;
        }

        $feed = new Feed();
        $feeds = $feed->getFeeds($size);

//        $feed = $this->_getFeedData();
        return new ViewModel(array(
            'feed' => $feeds
            )
        );
    }
}
