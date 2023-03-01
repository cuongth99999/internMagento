<?php

namespace Magenest\Movie\Plugin\Minicart;

class Image
{
    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\GroupedProduct\Model\Product\Type\GroupedFactory $groupedFactory,
        \Magento\Store\Model\StoreManagerInterfaceFactory $storeManagerInterfaceFactory
    ) {
        $this->productFactory = $productFactory;
        $this->GroupedFactory = $groupedFactory;
        $this->StoreManagerInterfaceFactory = $storeManagerInterfaceFactory;
    }

    public function aroundGetItemData($subject, $proceed, $item)
    {
        $result = $proceed($item);
        $product = $this->productFactory->create()->load($result['product_id']);
        $parentId = $this->GroupedFactory->create()->getParentIdsByChild($result['product_id']);

        /* thumb url */
        $storeManager = $this->StoreManagerInterfaceFactory->create();
        $currentStore = $storeManager->getStore();
        $mediaUrl = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        if (isset($parentId[0])) {
            $id = $parentId[0];
            $productdata = $this->productFactory->create()->load($id);
            $result['product_image']['src'] = $mediaUrl . "catalog/product" . $productdata->getThumbnail();
            $result['product_name'] = $result['product_sku'];
        } else {
            $result['product_image']['src'];
            $result['product_name'] = $result['product_sku'];
        }
        return $result;
    }
}
