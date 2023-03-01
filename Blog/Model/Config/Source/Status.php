<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magenest\Blog\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\InventoryApi\Api\Data\SourceItemInterface;

/**
 * Provide option values for UI
 */
class Status implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'enable',
                'label' => 'Enable',
            ],
            [
                'value' => 'disable',
                'label' => 'Disable',
            ],
        ];
    }
}
