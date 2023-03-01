<?php
namespace Magenest\Movie\Model\Config\Source;

class Show implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Show')], ['value' => 2, 'label' => __('Not Show')]];
    }

    public function toArray()
    {
        return [1 => __('Show'), 2 => __('Not Show')];
    }
}

