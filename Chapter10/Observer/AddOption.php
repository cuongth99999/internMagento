<?php

namespace Magenest\Chapter10\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddOption implements ObserverInterface
{
    protected $_request;

    public function __construct(
        RequestInterface $request,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    )
    {
        $this->_request = $request;
        $this->date = $date;
    }

    public function execute(Observer $observer)
    {
        $date = $this->_request->getParam('delivery_time');
        if (!$date) {
            $date = $this->date->gmtDate();
        }
        $observer->getData('quote_item')->setData('delivery_time', $date)->save();
    }
}
