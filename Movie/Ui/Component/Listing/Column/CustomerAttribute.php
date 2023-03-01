<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class CustomerAttribute extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        array              $components = [],
        array              $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['avatar'])) {
                    $item['avatar'] = 'http://testmagento2.local/media/customer' . $item['avatar'];
                    $src_img = $item['avatar'];
//                    $item['avatar'] = "<img src=\"" . 'http://testmagento2.local/media/customer/a/v/avt_3.jpg' . "\">";
                    $item['avatar'] = "<img src=\"" . $src_img . "\">";
                }
            }
            return $dataSource;
        }
    }
}
