<?php

namespace Magenest\Blog\Model\ResourceModel\MagenestBlog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'blog_id';

    protected function _construct()
    {
        $this->_init('Magenest\Blog\Model\MagenestBlog', 'Magenest\Blog\Model\ResourceModel\MagenestBlog');
    }
}
