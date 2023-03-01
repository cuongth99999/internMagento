<?php

namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

use Magenest\Movie\Block\Data as Actor;
use Magenest\Movie\Model\ResourceModel\Currency\Collection as CollectionMagenestActor;

class RowMagenestActor extends Field
{
    /**
     * Template path
     *
     * @var string
     */
//    protected $_template = 'Magenest_Movie::system/config/row_magenest_actor.phtml';

    /**
     * @param  Context     $context
     * @param  Actor     $actor
     * @param  CollectionMagenestActor $collectionActor
     * @param  array       $data
     */
    public function __construct(
        Context $context,
        Actor $actor,
        CollectionMagenestActor $collectionActor,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->actor = $actor;
        $this->collectionActor = $collectionActor;
    }

    /**
     * Remove scope label
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->getRow();
    }

    /**
     * Generate collect button html
     *
     * @return string
     */
    public function getRow()
    {
        return __(count($this->actor->getCollection()));
    }
}
