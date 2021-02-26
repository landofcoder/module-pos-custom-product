<?php

namespace Lof\CustomProduct\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Setup\CategorySetupFactory;

class AddPosCashierNameAttribute implements DataPatchInterface, PatchRevertableInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CategorySetupFactory $categorySetupFactory */
        $eavSetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'pos_cashier_name',
            [
                'type' => 'varchar',
                'label' => 'POS Cashier Name',
                'input' => 'text',
                'source' => '',
                'visible' => true,
                'required' => false,
                'position' => 334,
                'system' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'user_defined' => false,
                'used_in_product_listing' => false,
                'unique' => false,
                'backend' => '',
                'group'                         => 'General',
                'is_global'                     => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'used_for_price_rules'          => true,
                'used_for_sort_by'              => false,
                'is_configurable'               => true,
                'is_searchable'                 => false,
                'is_visible_in_advanced_search' => false,
                'is_comparable'                 => false,
                'is_filterable'                 => false,
                'is_filterable_in_search'       => false,
                'apply_to'=>'custom_product_type_code'
            ]
        );
        
          $attribute = $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, 'pos_cashier_name');

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var CategorySetupFactory $categorySetupFactory */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'pos_cashier_name');

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
        
        ];
    }
}