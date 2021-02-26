<?php
namespace Lof\CustomProduct\Model;
use Lof\CustomProduct\Api\CustomProductManagementInterface;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Catalog\Model\ProductFactory;
use Psr\Log\LoggerInterface ;

class CustomProductManagement implements CustomProductManagementInterface
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var ProductFactory
     */
    protected $product;
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(Request $request, ProductFactory $product,LoggerInterface $logger)
    {
        $this->request = $request;
        $this->product = $product;
        $this->logger = $logger;
    }

    /**
     * @return mixed
     */
    public function addCustomProduct()
    {
        $products[] = $this->request->getBodyParams();
        $productLists = $products[0]['product'];
        foreach($productLists as $product)
        {
            $typeId = $product['type_id'];
            $attribute_set_id = $product['attribute_set_id'];
            $sku = $product['sku'];
            $name = $product['name'];
            $weight = $product['weight'];
            $price = $product['price'];
            $status = $product['status'];
            $cost = $product['cost'];
            $visibility = $product['visibility'];
            $urlKey = $product['custom_attributes']['url_key'];
            $description = $product['custom_attributes']['description'];
            $pos_cashier_email = $product['custom_attributes']['pos_cashier_email'];
            $pos_cashier_name = $product['custom_attributes']['pos_cashier_name'];
            $pos_cashier_id = $product['custom_attributes']['pos_cashier_id'];
            $pos_outlet_id = $product['custom_attributes']['pos_outlet_id'];
            $pos_outlet_name = $product['custom_attributes']['pos_outlet_name'];
            $qty = $product['extension_attributes']['stockItem']['qty'];
            $use_config_manage_stock =  $product['extension_attributes']['stockItem']['use_config_manage_stock'];
            $manage_stock = $product['extension_attributes']['stockItem']['manage_stock'];
            $min_sale_qty = $product['extension_attributes']['stockItem']['min_sale_qty'];
            $max_sale_qty = $product['extension_attributes']['stockItem']['max_sale_qty'];
            $is_in_stock = $product['extension_attributes']['stockItem']['is_in_stock'];
        }
           $CustomProduct = $this->product->create();
           try{
                $CustomProduct
                 ->setName($name)
                 ->setSku($sku)
                 ->setTypeId($typeId)
                 ->setAttributeSetId($attribute_set_id)
                ->setWeight($weight)
                ->setStatus($status)
                ->setPrice($price)
                ->setCost($cost)
                ->setVisibility($visibility)
                ->setStockData(["use_config_manage_stock"=>$use_config_manage_stock,
                                "qty"=>$qty,
                                "manage_stock"=>$manage_stock,
                                "min_sale_qty"=>$min_sale_qty,
                                "max_sale_qty"=>$max_sale_qty,
                                "is_in_stock"=>$is_in_stock])
                ->setDescription($description)
                ->setPosCashierEmail($pos_cashier_email)
                ->setPosCashierName($pos_cashier_name)
                ->setPosCashierId($pos_cashier_id)
                ->setPosOutletId($pos_outlet_id)
                ->setPosOutletName($pos_outlet_name)
                ->setUrlkey($urlKey);
                $CustomProduct->save();
          }catch(Exception $e)
           {
            $this->logger->critical($e->getMessage());
           }

    }

}