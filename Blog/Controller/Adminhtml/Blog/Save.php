<?php

namespace Magenest\Blog\Controller\Adminhtml\Blog;

use Magento\Backend\App\Action;
use Magenest\Blog\Model\MagenestBlogFactory;

class Save extends Action
{
    /**
     * @var MagenestBlogFactory
     */
    private $actorFactory;

    /**
     * @var \Magento\UrlRewrite\Model\UrlRewriteFactory
     */
    protected $_urlRewriteFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param MagenestBlogFactory $actorFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory,
        MagenestBlogFactory $actorFactory
    ) {
        parent::__construct($context);
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->actorFactory = $actorFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['blog_addnewblog']['blog_id']) ? $data['blog_addnewblog']['blog_id'] : null;
        if ($movieDataPost = $data['blog_addnewblog']) {
            $newData = [
                'title' => $movieDataPost['title'],
                'url_rewrite' => $movieDataPost['url_rewrite'],
                'description' => $movieDataPost['description'],
                'content' => $movieDataPost['content'],
                'status' => $movieDataPost['status'],
                'author_id' => $_SESSION['admin']['user']->getData('user_id')
            ];

            $post = $this->actorFactory->create();

            $urlRewrite = $this->_urlRewriteFactory->create();

            $getRewriteByRequestpath = $urlRewrite->getCollection()
                ->addFieldToFilter('request_path', $movieDataPost['url_rewrite'])
                ->getData();
            if(count($getRewriteByRequestpath)>0)
            {
                if($getRewriteByRequestpath[0]['entity_id'] != $id)
                {
                    $this->messageManager->addErrorMessage(__('Url Rewrite existed.'));
                    return $this->resultRedirectFactory->create()->setRefererUrl();
                }
            }

            if ($id) {
                $post->load($id);
                $getRewriteByTargetPath = $urlRewrite->getCollection()
                    ->addFieldToFilter('target_path', 'blog/view/index/id/'.$id)
                    ->getData();
                $urlRewrite->load($getRewriteByTargetPath[0]['url_rewrite_id']);
            } try {
                $post->addData($newData);
                $post->save();
                $page = array (
                    'entity_type' => 'view',
                    'entity_id' => $post->getData('id'),
                    'request_path' => $post->getData('url_rewrite'),
                    'target_path' => 'blog/view/index/id/'.$post->getData('blog_id'),
                    'store_id' => 1
                );
                $urlRewrite->addData($page);
                $urlRewrite->save();
                $this->messageManager->addSuccessMessage(__('You saved the blog.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $this->resultRedirectFactory->create()->setPath('blog/blog/index');
    }
}
