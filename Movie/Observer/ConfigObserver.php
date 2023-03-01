<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class ConfigObserver implements ObserverInterface
{
    const XML_PATH_FAQ_URL = 'magenest/general/text_field';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * ConfigChange constructor.
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface  $configWriter
    )
    {
        $this->request = $request;
        $this->configWriter = $configWriter;

    }

    public function execute(EventObserver $observer)
    {
        $faqParams = $this->request->getParam('groups');
        $urlKey = $faqParams['general']['fields']['text_field']['value']; //Current faq_url value, Here you can filter current value
        if ($urlKey == 'Ping') {
            $this->configWriter->save('magenest/general/text_field', 'Pong');
        } else {
            $this->configWriter->save('magenest/settings/text_field', $urlKey);
        }
        return $this;
    }
}
