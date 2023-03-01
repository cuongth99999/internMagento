<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\Movie\Block\Account\Dashboard;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Helper\View;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Newsletter\Model\Subscriber;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Store\Model\StoreManagerInterface;
/**
 * Dashboard Customer Info
 *
 * @api
 * @since 100.0.2
 */
class Avatar extends Template
{
    /**
     * Cached subscription object
     *
     * @var Subscriber
     */
    protected $_subscription;

    /**
     * @var SubscriberFactory
     */
    protected $_subscriberFactory;

    /**
     * @var View
     */
    protected $_helperView;

    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CurrentCustomer $currentCustomer
     * @param SubscriberFactory $subscriberFactory
     * @param View $helperView
     * @param array $data
     */

    protected $_customerGroupCollection;

    private $file;
    private $dir;

    public function __construct(
        Context $context,
        CurrentCustomer $currentCustomer,
        SubscriberFactory $subscriberFactory,
        View $helperView,
        StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem\Io\File $file,
        \Magento\Framework\Filesystem\DirectoryList $dir,
        \Magento\Customer\Model\Group $customerGroupCollection,
        array $data = []
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->_subscriberFactory = $subscriberFactory;
        $this->_helperView = $helperView;
        $this->storeManager = $storeManager;
        $this->file = $file;
        $this->dir = $dir;
        $this->_customerGroupCollection = $customerGroupCollection;
        parent::__construct($context, $data);
    }

    /**
     * Returns the Magento Customer Model for this block
     *
     * @return CustomerInterface|null
     */

    public function getCustomer()
    {
        try {
            return $this->currentCustomer->getCustomer();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Get the full name of a customer
     *
     * @return string full name
     */
    public function getName()
    {
        return $this->_helperView->getCustomerName($this->getCustomer());
    }

    public function getMediaUrl()
    {
        $storeCode = $this->storeManager->getStore()->getCode();
        $storeUrl = $this->storeManager->getStore()->getBaseUrl();
        return str_replace($storeCode.'/', 'pub/media/', $storeUrl);
    }

    public function getCustomerImageUrl($filePath)
    {
        return $this->getMediaUrl() . 'media/customer' . $filePath;
    }

    public function getFileUrl()
    {
        if (!empty($url = $this->getCustomer()->getCustomAttribute("avatar"))) {
            return $this->getCustomerImageUrl($url->getValue());
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    protected function _toHtml()
    {
        return $this->currentCustomer->getCustomerId() ? parent::_toHtml() : '';
    }

    public function getCustomerGroup()
    {
        $currentGroupId = $this->getCustomer()->getGroupId(); //Get current customer group ID
        $collection = $this->_customerGroupCollection->load($currentGroupId);
        return $collection->getCustomerGroupCode();//Get current customer group name
    }
}
