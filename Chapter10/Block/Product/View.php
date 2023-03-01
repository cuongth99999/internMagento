<?php
namespace Magenest\Chapter10\Block\Product;

use Magento\Framework\View\Element\Template;

class View extends Template
{
    protected $_customerSession;

    public function __construct(
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getName() {
        return 'ok';
    }
}
