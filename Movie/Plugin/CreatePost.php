<?php

namespace Magenest\Movie\Plugin;

use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

class CreatePost
{
    /**
     * @var MessageManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        MessageManagerInterface $messageManager
    )
    {
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

    public function aroundExecute(\Magento\Customer\Controller\Account\CreatePost $subject, callable $proceed)
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $subject->getRequest()->getParams();
        $telephone = $params['telephone'];
        if(!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $telephone))
        {
            $this->messageManager->addErrorMessage(__('Incorrect phone number format.'));
            return $resultRedirect->setPath('*/*/create');
        }
        return $proceed();
    }
}
