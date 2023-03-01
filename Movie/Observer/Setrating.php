<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;

class Setrating implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        $rating = $observer->getEvent()->getData('movieData');
        $rating->setRating(0);
    }
}
