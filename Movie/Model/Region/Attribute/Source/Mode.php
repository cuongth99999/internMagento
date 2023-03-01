<?php

namespace Magenest\Movie\Model\Region\Attribute\Source;

class Mode extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                [
                    'value' => '',
                    'label' => 'Please Select',
                ],
                [
                    'value' => 'Bắc',
                    'label' => 'Bắc',
                ],
                [
                    'value' => 'Trung',
                    'label' => 'Trung',
                ],
                [
                    'value' => 'Nam',
                    'label' => 'Nam',
                ]
            ];
        }
        return $this->_options;
    }
}
