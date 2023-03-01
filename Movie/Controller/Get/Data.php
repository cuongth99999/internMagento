<?php
namespace Magenest\Movie\Controller\Get;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Data extends Action
{
    protected $postFactory;

    public function __construct(
        Context                                $context,
        \Magenest\Movie\Model\CurrencyFactory $postFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->postFactory = $postFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Movie\'s List'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}
