<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magenst\Movie\Block\Adminhtml\Form\Field\DateField;
use Magento\Framework\DataObject;

/**
 * Adminhtml catalog inventory "Minimum Qty Allowed in Shopping Cart" field
 *
 * @api
 * @since 100.0.2
 *
 * @deprecated 100.3.0 Replaced with Multi Source Inventory
 * @link https://devdocs.magento.com/guides/v2.4/inventory/index.html
 * @link https://devdocs.magento.com/guides/v2.4/inventory/inventory-api-reference.html
 */
class CustomerGroup extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    /**
     * @var Customergroup
     */
    protected $_groupRenderer;

    /**
     * Retrieve group column renderer
     *
     * @return Customergroup
     */
    protected function _getGroupRenderer()
    {
        if (!$this->_groupRenderer) {
            $this->_groupRenderer = $this->getLayout()->createBlock(
                \Magento\CatalogInventory\Block\Adminhtml\Form\Field\Customergroup::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->_groupRenderer->setClass('customer_group_select admin__control-select');
        }
        return $this->_groupRenderer;
    }

    /**
     * Prepare to render
     *
     * @return void
     */
    protected function _prepareToRender()
    {
        $this->addColumn('customer_group', [
            'label' => __('Customer Group'),
            'style' => 'width:200px',
            'renderer' => $this->getCustomerGroupRenderer()
        ]);
        $this->addColumn('course_start', [
            'label' => __('Start'),
            'id' => 'course_start',
            'class' => 'daterecuring',
            'style' => 'width:100px'
        ]);
        $this->addColumn('course_end', [
            'label' => __('End'),
            'id' => 'course_end',
            'class' => 'daterecuring',
            'style' => 'width:100px'
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param \Magento\Framework\DataObject $row
     * @return void
     */
    protected function _prepareArrayRow(\Magento\Framework\DataObject $row)
    {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->_getGroupRenderer()->calcOptionHash($row->getData('customer_group_id'))] =
            'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }

//    protected function _prepareArrayRow(DataObject $row): void
//    {
//        $options = [];
//
//        $tax = $row->getTax();
//        if ($tax !== null) {
//            $options['option_' . $this->getCustomerGroupRenderer()->calcOptionHash($tax)] = 'selected="selected"';
//        }
//
//        $row->setData('option_extra_attrs', $options);
//    }

    protected function _getDateColumnRenderer()
    {
        if (!$this->_dateRenderer) {
            $this->_dateRenderer = $this->getLayout()->createBlock(
                DateField::class,
                '',
                [
                    'data' => [
                        'is_render_to_js_template' => true,
                        'date_format'              => 'dd/mm/Y'
                    ]
                ]
            );
        }

        return $this->_dateRenderer;
    }

    private function getCustomerGroupRenderer()
    {
        if (!$this->_groupRenderer) {
            $this->_groupRenderer = $this->getLayout()->createBlock(
                \Magento\CatalogInventory\Block\Adminhtml\Form\Field\Customergroup::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->_groupRenderer->setClass('customer_group_select admin__control-select');
        }
        return $this->_groupRenderer;
    }
}
