<?php
namespace Magenest\Chapter10\Block\Index;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $_customerSession;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json,
        array $data = []
    )
    {
        $this->json = $json;
        parent::__construct($context, $data);
    }

    public function getCustomerGroupIdCurrent(){
        return $_SESSION['customer_base']['customer_group_id'];
    }

    public function getCustomerGroupConfig() {
        $configData = $this->_scopeConfig
            ->getValue('magenest/promotion/customer_group',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        return $configData;
    }

    public function getPromotionTextValue() {
        $configData = $this->_scopeConfig
            ->getValue('magenest/promotion/text_field',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        return $configData;
    }

    public function getColorValue() {
        $configDataJson = $this->_scopeConfig
            ->getValue('magenest/color/color_field',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $configData = $this->json->unserialize($configDataJson);
        return $configData;
    }
}
