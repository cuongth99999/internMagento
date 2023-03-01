<?php
namespace Magenest\Movie\Model\ResourceModel\Currency;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'actor_id';

    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\Currency', 'Magenest\Movie\Model\ResourceModel\Currency');
    }
}
