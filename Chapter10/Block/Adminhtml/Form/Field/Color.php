<?php

namespace Magenest\Chapter10\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Color extends AbstractFieldArray
{
    protected $colorRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('color', [
            'label' => __('Color'),
            'id' => 'color',
            'class' => 'color',
            'style' => 'width:200px',
        ]);

        $this->addColumn(
            'color_picker',
            [
                'label' => __("ColorPicker"),
                'renderer' => $this->getColorRenderer(),
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    private function getColorRenderer()
    {
        if (!$this->colorRenderer) {
            $this->colorRenderer = $this->getLayout()->createBlock(
                \Magenest\Chapter10\Block\Color::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->colorRenderer;
    }
}
