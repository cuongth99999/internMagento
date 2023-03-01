<?php

namespace Magenest\Movie\Plugin\Address;

class FormPost
{
    /**
     * @var \Magento\Customer\Api\AddressRepositoryInterface
     */

    /**
     * @param \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
     */
    protected $_addressRepository;

    public function __construct(
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
    ) {
        $this->_addressRepository = $addressRepository;
    }

    public function afterExecute(\Magento\Customer\Controller\Address\FormPost $subject, $result)
    {
        $params = $subject->getRequest()->getParams();
        $address = $this->_addressRepository->getById($params['id']);
        if($address && $address->getId()) {
            $address->setCustomAttribute('vn_region_id', $params['vn_region_id']);
            $this->_addressRepository->save($address);
        }
        return $result;
    }
}
