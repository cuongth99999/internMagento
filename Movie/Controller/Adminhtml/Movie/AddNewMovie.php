<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\Http;

class AddNewMovie extends \Magento\Backend\App\Action
{
    protected $_pageFactory;
    protected $request;
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        Http $request
    )
    {
        $this->request = $request;
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->request->getParam('movie_id');
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        if(empty($id)){
            $resultPage->getConfig()->getTitle()->prepend(__('Add Movie'));
        } else{
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Movie'));
        }
        return $resultPage;
    }
}
