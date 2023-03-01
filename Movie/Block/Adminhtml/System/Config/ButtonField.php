<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;

class ButtonField extends \Magento\Config\Block\System\Config\Form\Field
{
//    $_template = 'Magenest_Movie::adminhtml/custom_button.phtml';
    public function __construct(
        Context $context,
        array   $data = []
    ) {
        parent::__construct($context, $data);
    }

//    protected function _prepareLayout()
//    {
//        parent::_prepareLayout();
//        if (!$this->getTemplate()) {
//            $this->setTemplate('system/config/fieldset/custom_button.phtml');
//        }
//
//        return $this;
//    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
//        return $this->_toHtml();
        $html = '<button onclick="refresh()">Reload page</button>';
        return $html;
    }

}
