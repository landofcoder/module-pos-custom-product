<?php
namespace Lof\CustomProduct\Model\Product\Type;

class CustomProductTypeCode extends \Magento\Catalog\Model\Product\Type\Simple
{

    const TYPE_ID = 'custom_product_type_code';

    /**
     * {@inheritdoc}
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // method intentionally empty
    }
}