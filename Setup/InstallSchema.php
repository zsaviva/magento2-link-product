<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagePal\LinkProduct\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /**
         * Install product link types in table (catalog_product_link_type)
         */
        $catalogProductLinkTypeData = [
            'link_type_id' => \MagePal\LinkProduct\Model\Product\Link::LINK_TYPE_ACCESSORY,
            'code' => \MagePal\LinkProduct\Ui\DataProvider\Product\Form\Modifier\Accessory::DATA_SCOPE_ACCESSORY
        ];

        $setup->getConnection()->insertOnDuplicate(
            $setup->getTable('catalog_product_link_type'),
            $catalogProductLinkTypeData
        );

        /**
         * install product link attributes position in table catalog_product_link_attribute
         */
        $catalogProductLinkAttributeData = [
            'link_type_id' => \MagePal\LinkProduct\Model\Product\Link::LINK_TYPE_ACCESSORY,
            'product_link_attribute_code' => 'position',
            'data_type' => 'int',
        ];

        $setup->getConnection()->insert(
            $setup->getTable('catalog_product_link_attribute'),
            $catalogProductLinkAttributeData
        );

        $setup->endSetup();
    }
}
