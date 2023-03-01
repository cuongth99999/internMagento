<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Customer;

class ChangeName implements \Magento\Framework\Event\ObserverInterface
{
    protected $_customerRepoInterface;
    protected $_customerFactory;

    public function __construct(
        CustomerRepositoryInterface $customerRepoInterface,
        StoreManagerInterface $storeRepoInterface
    ) {
        $this->_customerRepoInterface = $customerRepoInterface;
        $this->_storeRepoInterface = $storeRepoInterface;
    }

    public function execute(Observer $observer)
    {
//        $websiteId = $this->_storeRepoInterface->getStore()->getWebsiteId();
//        $customerEmail = $observer->getData('email');
//
//        $custo = $this->_customerRepoInterface->get($customerEmail, $websiteId);
//        $custo->setFirstname("Magenest");
//        $this->_customerRepoInterface->save($custo);
        $customer = $observer->getEvent()->getCustomer();
        $customerData = $customer->getDataModel();
        $customerData->setFirstname("Magenest");
        $customer->updateData($customerData);
        $customer->save();
    }
}
