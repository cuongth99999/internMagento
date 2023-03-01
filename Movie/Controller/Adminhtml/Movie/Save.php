<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\MovieFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    private $movieFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param MovieFactory $movieFactory
     */
    public function __construct(
        Action\Context $context,
        MovieFactory $movieFactory
    ) {
        parent::__construct($context);
        $this->movieFactory = $movieFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['magenest_movie_addnewmovie']['movie_id']) ? $data['magenest_movie_addnewmovie']['movie_id'] : null;

        if ($movieDataPost = $data['magenest_movie_addnewmovie']) {
            if($movieDataPost['rating'] < 0 || is_int((int)$movieDataPost['rating']) == false)
            {
                $this->messageManager->addErrorMessage('Rating must greater than 0');
                return $this->resultRedirectFactory->create()->setPath($_SERVER['HTTP_REFERER']);
            }

            $newData = [
                'name' => $movieDataPost['name'],
                'description' => $movieDataPost['description'],
                'rating' => $movieDataPost['rating'],
                'director_id' => $movieDataPost['director_id'],
            ];

            $post = $this->movieFactory->create();

            if ($id) {
                $post->load($id);
            }
            try {
                $post->addData($newData);
                $this->_eventManager->dispatch("magenest_movie_save_movie", ['movieData' => $post]);
                $post->save();

                $this->messageManager->addSuccessMessage(__('You saved the movie.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $this->resultRedirectFactory->create()->setPath('magenest_movie/movie/index');
    }
}
