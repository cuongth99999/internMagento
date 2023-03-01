<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddProductAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $setup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    private $dir;
    private $file;
    /**
     * AccountPurposeCustomerAttribute constructor.
     * @param ModuleDataSetupInterface $setup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        EavSetupFactory $eavSetupFactory,
        DirectoryList $dir,
        File $file
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->setup = $setup;
        $this->dir = $dir;
        $this->file = $file;
    }

    public function apply()
    {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->setup]);

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'course_start');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'course_start',
            [
                'label' => 'Course Start',
                'group' => 'Course Schedule',
                'type' => 'datetime',
                'input' => 'date',
                'class' => 'validate-date',
                'backend' => \Magento\Catalog\Model\Attribute\Backend\Startdate::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => true,
                'filterable' => true,
                'filterable_in_search' => true,
                'visible_in_advanced_search' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'unique' => false
            ]
        );
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'course_end');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'course_end',
            [
                'label' => 'Course End',
                'group' => 'Course Schedule',
                'type' => 'datetime',
                'input' => 'date',
                'class' => 'validate-date',
                'backend' => \Magento\Catalog\Model\Attribute\Backend\Startdate::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => true,
                'filterable' => true,
                'filterable_in_search' => true,
                'visible_in_advanced_search' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'unique' => false
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    public static function getVersion()
    {
        return '1.0.1';
    }
}
