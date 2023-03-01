<?php

namespace Magenest\Movie\Block\Address;

use Magento\Framework\UrlInterface;

class Edit extends \Magento\Customer\Block\Address\Edit
{
    public function getAllOptions()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager
            ->create('Magenest\Movie\Model\Region\Attribute\Source\Mode')
            ->getAllOptions();
    }
}
