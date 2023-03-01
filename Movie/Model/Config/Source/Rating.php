<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magenest\Movie\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\InventoryApi\Api\Data\SourceItemInterface;

/**
 * Provide option values for UI
 */
class Rating implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 1,
                'label' => '1 Star',
            ],
            [
                'value' => 2,
                'label' => '2 Star',
            ],
            [
                'value' => 3,
                'label' => '3 Star',
            ],
            [
                'value' => 4,
                'label' => '4 Star',
            ],
            [
                'value' => 5,
                'label' => '5 Star',
            ],
        ];
    }
}
