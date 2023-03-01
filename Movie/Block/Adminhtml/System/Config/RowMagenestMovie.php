<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

use Magenest\Movie\Block\Data as Movie;

class RowMagenestMovie extends Field
{

//    protected $_template = 'Magenest_Movie::system/config/row_magenest_movie.phtml';

    /**
     * @param  Context     $context
     * @param  Movie     $movie
     * @param  array       $data
     */
    public function __construct(
        Context $context,
        Movie $movie,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->movie = $movie;
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
        return __(count($this->movie->getMovie()));
    }
}
