<?php
namespace Magenest\Movie\Model;
use Magento\Framework\Model\AbstractModel;

class Director extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Director');
    }
}
