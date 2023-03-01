<?php
namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ProductAttributeAlcoholic implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /** We'll add our customer attribute here */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'alcoholic_strength', [
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => 'Alcoholic Strength',
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'volume', [
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => 'Volume',
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'origin', [
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => 'Origin',
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'freeze', [
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => 'Freeze',
            'input' => 'select',
            'class' => '',
            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'material', [
            'type' => 'text',
            'backend' => '',
            'frontend' => '',
            'label' => 'Material',
            'input' => 'text',
            'class' => '',
            'source' => '',
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => '',
        ]);

//        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'grape_type', [
//            'type' => 'int',
//            'backend' => '',
//            'frontend' => '',
//            'label' => 'Grapes type',
//            'input' => 'select',
//            'class' => '',
//            'source' => '',
//            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
//            'visible' => true,
//            'required' => true,
//            'user_defined' => false,
//            'default' => 0,
//            'searchable' => false,
//            'filterable' => false,
//            'comparable' => false,
//            'visible_on_front' => false,
//            'used_in_product_listing' => true,
//            'unique' => false,
//            'apply_to' => '',
//            'swatch_input_type' => 'visual',
//            'swatch_visual' => [
//                'value' => [
//                    'option_1' => ['label' => 'Nho loại 1', 'value' => '1'],
//                    'option_2' => ['label' => 'Nho loại 2', 'value' => '2'],
//                    'option_3' => ['label' => 'Nho loại 3', 'value' => '3'],
//                    'option_4' => ['label' => 'Nho loại 4', 'value' => '4'],
//                    'option_5' => ['label' => 'Nho loại 5', 'value' => '5']
//                ]
//            ],
//            'option' => [
//                'values' => [
//                    'option_1' => ['Nho loại 1'],
//                    'option_2' => ['Nho loại 2'],
//                    'option_3' => ['Nho loại 3'],
//                    'option_4' => ['Nho loại 4'],
//                    'option_5' => ['Nho loại 5']
//                ]
//            ]
//        ]);
    }
    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
