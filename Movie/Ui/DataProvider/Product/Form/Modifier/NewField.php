<?php

namespace Magenest\Movie\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\Form\Fieldset;

/**
 * Data provider for "Custom Attribute" field of product page
 */
class NewField extends AbstractModifier
{
    /**
     * @param ArrayManager  $arrayManager
     */
    public function __construct(
        ArrayManager $arrayManager
    ) {
        $this->arrayManager = $arrayManager;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $meta = $this->enableTime($meta);
        $meta = $this->disableTime($meta);
        $meta = array_replace_recursive(
            $meta,
            [
                'course-schedule' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Course Schedule'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ]
                ],
            ]
        );
        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Customise Custom Attribute field
     *
     * @param array $meta
     *
     * @return array
     */
    protected function enableTime(array $meta)
    {
        $fieldCode = 'course_start';

        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCode, $meta, null, 'children');

        if (!$elementPath) {
            return $meta;
        }

        $meta = $this->arrayManager->merge(
            $containerPath,
            $meta,
            [
                'children'  => [
                    $fieldCode => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'default' => '',
                                    'options'       => [
                                        'dateFormat' > 'Y-m-d',
                                        'timeFormat' => 'HH:mm:ss',
                                        'showsTime' => true,
                                        'minDate' => 8 - (int)date('d'),
                                        'maxDate' => 12 - (int)date('d')
                                    ]
                                ],
                            ],
                        ],
                    ],
                ]
            ]
        );


        return $meta;
    }

    protected function disableTime(array $meta)
    {
        $fieldCodeEnd = 'course_end';

        $elementPath = $this->arrayManager->findPath($fieldCodeEnd, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCodeEnd, $meta, null, 'children');

        if (!$elementPath) {
            return $meta;
        }

        $meta = $this->arrayManager->merge(
            $containerPath,
            $meta,
            [
                'children'  => [
                    $fieldCodeEnd => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'default' => '',
                                    'options'       => [
                                        'dateFormat' > 'Y-m-d',
                                        'timeFormat' => 'HH:mm:ss',
                                        'showsTime' => true,
                                        'minDate' => 8 - (int)date('d'),
                                        'maxDate' => 12 - (int)date('d')
                                    ]
                                ],
                            ],
                        ],
                    ],
                ]
            ]
        );
        return $meta;
    }
}
