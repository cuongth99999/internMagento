<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\CurrencyFactory;
use Magento\Backend\App\Action;

class SaveActor extends Action
{
    private $actorFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param CurrencyFactory $currencyFactory
     */
    public function __construct(
        Action\Context $context,
        CurrencyFactory $currencyFactory
    ) {
        parent::__construct($context);
        $this->currencyFactory = $currencyFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['magenest_movie_addnewactor']['actor_id']) ? $data['magenest_movie_addnewactor']['actor_id'] : null;

        if ($actorDataPost = $data['magenest_movie_addnewactor']) {

            $newData = [
                'name' => $actorDataPost['actor_name'],
            ];

            $post = $this->currencyFactory->create();

            if ($id) {
                $post->load($id);
            }
            try {
                $post->addData($newData);
                $this->_eventManager->dispatch("magenest_movie_save_actor", ['actorData' => $post]);
                $post->save();

                $this->messageManager->addSuccessMessage(__('You saved the actor.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $this->resultRedirectFactory->create()->setPath('magenest_movie/movie/actor');
    }
}
