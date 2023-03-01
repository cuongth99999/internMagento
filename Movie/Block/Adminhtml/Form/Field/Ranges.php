<?php

namespace Magenst\Movie\Block\Adminhtml\Form\Field;

use Magenst\Movie\Block\Adminhtml\Form\Field\DateField;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Ranges
 */
class Ranges extends AbstractFieldArray
{
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = parent::_getElementHtml($element);

        $script = '<script type="text/javascript">
                require([
                    "jquery",
                    "jquery/ui",
                    "mage/calendar"
                    ], function ($) {
                    $(function(){
                        function bindDatePicker() {
                            setTimeout(function() {
                                $(".daterecuring").datetimepicker( {
                                dateFormat: "mm/dd/yy",
                                minDate: 8,
                                maxDate: 12,
                                timeFormat: "HH:mm:ss",
                                showTime: true,
                                showHour: true,
                                showMinute: true,
                                } );
                            }, 50);
                        }
                        bindDatePicker();
                        $("button.action-add").on("click", function(e) {
                            bindDatePicker();
                        });
                    });
                });
            </script>';
        $html .= $script;
        return $html;
    }
}
