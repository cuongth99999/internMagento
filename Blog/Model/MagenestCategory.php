<?php

namespace Magenest\Blog\Model;

class MagenestCategory extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\Blog\Model\ResourceModel\MagenestCategory');
    }
}
