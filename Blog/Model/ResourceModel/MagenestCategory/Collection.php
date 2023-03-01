<?php

namespace Magenest\Blog\Model\ResourceModel\MagenestCategory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'category_id';

    protected function _construct()
    {
        $this->_init('Magenest\Blog\Model\MagenestCategory', 'Magenest\Blog\Model\ResourceModel\MagenestCategory');
    }
}
