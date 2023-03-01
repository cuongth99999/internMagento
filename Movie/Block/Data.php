<?php
namespace Magenest\Movie\Block;

use Magenest\Movie\Model\ResourceModel\Currency\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class Data extends Template
{
    public $collection;
    public $director;
    public $movie;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $directorFactory,
        \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory $movieFactory,
        array $data = []
    )
    {
        $this->collection = $collectionFactory;
        $this->director = $directorFactory;
        $this->movie = $movieFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        return $this->collection->create();
    }

    public function getDirector()
    {
        return $this->director->create();
    }

    public function getMovie()
    {
        return $this->movie->create();
    }
}
