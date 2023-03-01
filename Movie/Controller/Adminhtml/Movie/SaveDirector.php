<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\DirectorFactory;
use Magento\Backend\App\Action;

class SaveDirector extends Action
{
    private $actorFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DirectorFactory $directorFactory
     */
    public function __construct(
        Action\Context $context,
        DirectorFactory $directorFactory
    ) {
        parent::__construct($context);
        $this->directorFactory = $directorFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['magenest_movie_addnewmovie']['director_id']) ? $data['magenest_movie_addnewdirector']['director_id'] : null;

        if ($movieDataPost = $data['magenest_movie_addnewdirector']) {

            $newData = [
                'director_name' => $movieDataPost['director_name'],
            ];

            $post = $this->directorFactory->create();

            if ($id) {
                $post->load($id);
            }
            try {
                $post->addData($newData);
                $this->_eventManager->dispatch("magenest_movie_save_director", ['directorData' => $post]);
                $post->save();

                $this->messageManager->addSuccessMessage(__('You saved the director.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $this->resultRedirectFactory->create()->setPath('magenest_movie/movie/director');
    }
}
