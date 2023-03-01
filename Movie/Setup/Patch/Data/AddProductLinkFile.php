<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddProductLinkFile implements DataPatchInterface
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
        $images = $this->dir->getPath('media').'/magenestimage/tmp';
        if ( ! file_exists($images)) {
            $this->file->mkdir($images);
        }

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'link', [
            'type' => 'varchar',
            'input' => 'text',
            'label' => 'Link',
            'required' => false,
            'default' => '',
            'visible' => true,
            'user_defined' => true,
            'system' => false,
            'is_visible_in_grid' => true,
            'is_used_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'position' => 300
        ]);

        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'file', [
            'type' => 'varchar',
            'input' => 'image',
            'label' => 'File',
            'required' => false,
            'default' => '',
            'visible' => true,
            'user_defined' => true,
            'system' => false,
            'is_visible_in_grid' => true,
            'is_used_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'position' => 300
        ]);
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
