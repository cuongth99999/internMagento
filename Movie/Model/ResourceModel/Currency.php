<?php
namespace Magenest\Movie\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Currency extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('magenest_actor', 'actor_id');
    }
}
