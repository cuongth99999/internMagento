<?php

namespace Magenest\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magenest\Blog\Model\MagenestCategoryFactory;

class Save extends Action
{
    /**
     * @var MagenestCategoryFactory
     */
    private $actorFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param MagenestCategoryFactory $actorFactory
     */
    public function __construct(
        Action\Context $context,
        MagenestCategoryFactory $actorFactory
    ) {
        parent::__construct($context);
        $this->actorFactory = $actorFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['blog_addnewcategory']['id']) ? $data['blog_addnewcategory']['category_id'] : null;

        if ($movieDataPost = $data['blog_addnewcategory']) {
            $newData = [
                'name' => $movieDataPost['name'],
            ];

            $post = $this->actorFactory->create();

            if ($id) {
                $post->load($id);
            }
            try {
                $post->addData($newData);
                $post->save();
                $this->messageManager->addSuccessMessage(__('You saved the category blog.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $this->resultRedirectFactory->create()->setPath('blog/category/index');
    }
}
